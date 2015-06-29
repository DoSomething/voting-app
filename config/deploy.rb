# config/deploy.rb file
require 'bundler/capistrano'

set :application, "voting-app"
set :deploy_to, ENV["DEPLOY_PATH"]
server  ENV["SERVER_NAME"], :app, :web

gateway = ENV["GATEWAY"]
unless gateway.nil?
  set :gateway, ENV["GATEWAY"]
end

set :user, "dosomething"
set :group, "dosomething"
set :use_sudo, false

set :repository, "."
set :scm, :none
set :deploy_via, :copy
set :keep_releases, 1

ssh_options[:keys] = [ENV["CAP_PRIVATE_KEY"]]

default_run_options[:shell] = '/bin/bash'

namespace :deploy do
  folders = %w{logs dumps system}

  task :link_folders do
    run "ln -nfs #{shared_path}/.env #{release_path}/"
    run "ln -nfs #{shared_path}/images #{release_path}/public"
    run "ln -nfs #{shared_path}/thumbnails #{release_path}/public"
    folders.each do |folder|
      run "ln -nfs #{shared_path}/#{folder} #{release_path}/storage/#{folder}"
    end
  end

  task :artisan_migrate do
    run "cd #{release_path} && php artisan migrate --force"
  end

  task :artisan_cache_clear do
    run "cd #{release_path} && php artisan cache:clear"
  end

  task :react_render do
    run "forever stopall && forever start ../bootstrap/react_server.js"
  end

end

after "deploy:update", "deploy:cleanup"
after "deploy:symlink", "deploy:link_folders"
after "deploy:link_folders", "deploy:artisan_migrate"
after "deploy:artisan_migrate", "deploy:react_render,deploy:artisan_cache_clear"
