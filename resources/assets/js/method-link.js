import $ from 'jquery';

const $body = $('body');
const csrfToken = $('meta[name=csrf-token]').attr('content');

/**
 * Allow links to specify a HTTP method using `data-method`
 */
$(document).on('click', '[data-method]', function(event) {
  event.preventDefault();

  const url = $(this).attr('href');
  const method = $(this).data('method');

  const formItem = $(this).data('form-item');
  const formValue = $(this).data('form-value');

  let $form = $(`<form method="post" action="${url}"></form>`);
  let metadataInput = `<input name="_method" value="${method}" type="hidden" />`;

  if (csrfToken !== undefined) {
    metadataInput += `<input name="_token" value="${csrfToken}" type="hidden" />`;
  }

  if (formItem !== undefined && formValue !== undefined) {
    metadataInput += `<input name="${formItem}" value="${formValue}" type="hidden" />`;
  }

  $form.hide().append(metadataInput);
  $body.append($form);

  $form.submit();
});
