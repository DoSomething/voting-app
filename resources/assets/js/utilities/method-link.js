import delegate from 'dom-delegate';

let csrfTag = document.querySelectorAll('meta[name=csrf-token]');
if(csrfTag.length > 0) {
  var csrfToken = csrfTag[0].getAttribute('content');
}

/**
 * Allow links to specify a HTTP method using `data-method`
 */
delegate(document.body).on('click', '*[data-method]', function(event) {
  event.preventDefault();

  const url = this.getAttribute('href');
  const method = this.getAttribute('data-method');

  const formItem = this.getAttribute('data-form-item');
  const formValue = this.getAttribute('data-form-value');

  let form = document.createElement('form');
  form.setAttribute('method', 'post');
  form.setAttribute('action', url);
  form.setAttribute('style', 'display: none;');

  let metadataInput = `<input name="_method" value="${method}" type="hidden" />`;

  if (csrfToken !== undefined) {
    metadataInput += `<input name="_token" value="${csrfToken}" type="hidden" />`;
  }

  if (formItem !== undefined && formValue !== undefined) {
    metadataInput += `<input name="${formItem}" value="${formValue}" type="hidden" />`;
  }

  var e = document.createElement('div');
  e.innerHTML = metadataInput;
  form.appendChild(e);

  document.body.appendChild(form);

  form.submit();
});
