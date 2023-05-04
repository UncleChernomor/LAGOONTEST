'use strict';
const buttonSubmit = document.querySelector('input[type=submit]');

buttonSubmit.addEventListener('click', (e) => {
    e.preventDefault();

    clearFieldInfo();

    checkInput();

    const bodyRequest = {
        method: 'POST',
        body: new FormData(document.querySelector('form')),
    }

    fetch('check.php', bodyRequest )
        .then( response => {
            if (response.status === 200) {
                return response.json();
            } else {
                throw new Error("Something went wrong on API server!");
            }
        })
        .then( answer => {
            if ( answer.success === 0) {
               showErrorMessageForInfo(answer.error);
            } else {
                showSuccessMessageForInfo(answer.info);
                hideForm();
            }
            console.log('success: ' + answer.success);
            console.dir(answer);
        })
        .catch( error => {
            console.error(error);
        });
});

function clearFieldInfo() {
    const fieldInfo = document.querySelector('div#info-box');
    fieldInfo.className = "";
    fieldInfo.innerText = "Info desk";
    fieldInfo.classList.add('alert', 'alert-secondary');
}

function checkInput() {
    const listInput = document.querySelectorAll('form > p > input');
    listInput.forEach(item => {
        if( item.value.length < 5 ) {
            showErrorMessageForInfo("Value in input field less than 5 characters");
            return;
        }
    })
}

function showErrorMessageForInfo(errorMessage) {
    const fieldInfo = document.querySelector('div#info-box');
    fieldInfo.innerText = errorMessage;
    fieldInfo.className = "";
    fieldInfo.classList.add('alert', 'alert-danger');
}

function showSuccessMessageForInfo( $message ) {
    const fieldInfo = document.querySelector('div#info-box');
    fieldInfo.innerText = "Alright " + $message;
    fieldInfo.className = "";
    fieldInfo.classList.add('alert', 'alert-success');
}

function hideForm() {
    document.querySelector("form").style = 'display: none';
}