const validateRequireField = (id, form) => {
  if (form.get(id)) {
    document.getElementById(id).innerText = '';
    return true;
  }
  
  document.getElementById(id).innerText = `${id} is required`;
  return false;
};

const validate = (fields, idForm) => {
  const form = new FormData(document.getElementById(idForm));
  const results = fields.map(item => {
    return validateRequireField(item, form);
  });
  if (results.some(item => item === false)) {
    return false;
  }
  return true;
};

const validateSearch = (fields, idForm) => {
  const form = new FormData(document.getElementById(idForm));
  const results = fields.map(item => {
    return form.get(item) ? true : false;
  });
  if (results.every(item => item === false)) {
    document.getElementById('txtForm').innerText = 'You must select atleast one field for searching';
    return false;
  }
  return true;
};
