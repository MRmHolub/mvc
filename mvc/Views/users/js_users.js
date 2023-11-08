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
    const link = document.getElementById('dialog__confirm-link');
    const action_arr = link.dataset.action.split('/');
    var user_id = action_arr[2];
    var actionUrl = 'http://localhost/mvc/api/delete/' + user_id;

    fetch(actionUrl).then(response => {
        if (response.ok) {                                                                
            var user_id_str = 'row_' + user_id;
            const row = document.getElementById(user_id_str);
            row.innerHTML = '';            
            console.log('deleted');
        } else {                    
            console.error('not deleted');
        }
    });
}
        
const elements = document.querySelectorAll('.form-control');
const submitButton = document.getElementById('add_user_btn');
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
const anyInputEmpty = [...elements].some(elem => elem.validity.valueMissing);
const anyInputWrong = [...elements].some(elem => elem.validity.typeMisMatch);

console.log(anyInputEmpty);
console.log(anyInputWrong);

