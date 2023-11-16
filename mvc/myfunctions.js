const deleteButtons = document.querySelectorAll('.button--delete');  
            
deleteButtons.forEach(b => b.addEventListener('click', e => {
    const dialog = document.getElementById('dialog');        
    var action = b.dataset.action;

    const item = document.getElementById('dialog__item-to-delete');
    item.innerHTML = action.split('/').pop();
    

    const link = document.getElementById('dialog__confirm-link');
    action = b.dataset.action.replace('.', ''); 
    
    link.setAttribute('data-action', action);
    
    dialog.showModal();
}));

function closeDeleteDialog() {
    const dialog = document.getElementById('dialog');
    dialog.close();
}  


function ajaxDelete(){            
    var delete_link = document.getElementById('dialog__confirm-link');
    var action_arr = delete_link.dataset.action.split('/');
    var user_id = action_arr[2];
    var actionUrl = 'http://localhost/mvc/api/delete/' + user_id;

    fetch(actionUrl).then(response => {
        if (response.ok) {                                                                
            var user_id_str = 'row_' + user_id;
            var row = document.getElementById(user_id_str);
            row.innerHTML = '';            
            console.log('deleted');
        } else {                    
            console.error('not deleted');
        }
    });
}
        
const elements = document.querySelectorAll('.form-control');
const form = document.getElementById('add_user');                                                 


elements.forEach(elem => {
    elem.addEventListener('input', e => {
        
        if (elem.validity.typeMismatch) {
            elem.setCustomValidity('This is invalid input!');
            elem.reportValidity();                                                             
        } else {
            elem.setCustomValidity('');
        }
    
    });
});      

const submitButton = document.getElementById('add_user_btn');
if (submitButton){
    submitButton.addEventListener('click', function() {            
        const anyInputEmpty = [...elements].some(elem => elem.validity.valueMissing);
        const anyInputWrong = [...elements].some(elem => elem.validity.typeMisMatch);    

        if (anyInputEmpty || anyInputWrong){
            submitButton.disabled = true;
            showError(); 
            setInterval(checkCondition, 1000); 
        } else {
            submitButton.disabled = false;
        }
    });
}

function checkCondition(){
    const anyInputEmpty = [...elements].some(elem => elem.validity.valueMissing);
    const anyInputWrong = [...elements].some(elem => elem.validity.typeMisMatch);

    
    if (anyInputEmpty || anyInputWrong) {
        if (!submitButton.disabled) showError();                    
        submitButton.disabled = true; // Disable the button                    
        } else {
        submitButton.disabled = false; // Enable the button
        }                  
}


function showError(){
    elements.forEach(elem => {
        if (elem.validity.typeMismatch || elem.validity.valueMissing){
            elem.style.borderColor = 'red';
            elem.setCustomValidity('Tohle není správně vyplněno!');
            elem.reportValidity();     
        } else {
            elem.setCustomValidity('');
        }
    });
}



const container = document.getElementById('api_get_container');
var action_id = container.dataset.action;
var actionUrl = 'http://localhost/mvc/api/get';
const dataTable = document.getElementById('api_data_table');

if (action_id != ''){
    actionUrl = actionUrl + '/' + action_id;
}
console.log(actionUrl);

fetch(actionUrl)
.then(r => r.json())
.then(data => {    
    console.log(data);

    //delete previuos
    dataTable.querySelector('tbody').innerHTML = '';
    

    
    data.forEach(obj => {
      
      const email = obj.email;
      const last = obj.last;
      const name = obj.name;
      const phone = obj.phone;

      const newRow = dataTable.insertRow();
      
      const emailCell = newRow.insertCell(0);
      emailCell.textContent = email;

      const lastCell = newRow.insertCell(1);
      lastCell.textContent = last;

      const nameCell = newRow.insertCell(2);
      nameCell.textContent = name;

      const phoneCell = newRow.insertCell(3);
      phoneCell.textContent = phone;
    });
});

