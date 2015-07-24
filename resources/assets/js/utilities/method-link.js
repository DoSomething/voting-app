import delegate from 'dom-delegate';

/**
 * Allow links to specify a HTTP method using `data-method`
 */
function initialize() {
  const csrfTag = document.querySelectorAll('meta[name=csrf-token]');
  const csrfToken = csrfTag.length > 0 ? csrfTag[0].getAttribute('content') : null;

  delegate(document.body).on('click', '*[data-method]', function(event) {
    event.preventDefault();

    const url = this.getAttribute('href');
    const method = this.getAttribute('data-method');

    const formItem = this.getAttribute('data-form-item');
    const formValue = this.getAttribute('data-form-value');

    const form = document.createElement('form');
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

    const el = document.createElement('div');
    el.innerHTML = metadataInput;
    form.appendChild(el);

    document.body.appendChild(form);

    form.submit();
  });
}

export default { initialize };
