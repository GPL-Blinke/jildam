vex.dialog.buttons.YES.text = 'Aceptar';
vex.dialog.buttons.NO.text = 'Cancelar';

function alertDeletePass(id, token){
    vex.dialog.open({
        message: '¿Estás seguro de que quieres eliminar esta contraseña? Esta acción es irreversible.',
        className: 'vex-theme-default',
        input: [
            '<form action="/passwords" method="post">',
            `<input type="hidden" name="_token" value="${token}" />`,
            `<input type="hidden" name="delete" value="${id}" />`,
            '<button type="submit" class="vex-dialog-button-primary vex-dialog-button vex-first">Aceptar</button>',
            '<button type="button" onclick="vex.closeAll()" class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancelar</button>',
            '</form>'
        ].join(''),
        buttons: [],
        showCloseButton: false,
        callback: function (data) {}
    })
}

function alertDeleteAccount(token){
    vex.dialog.confirm({
        message: '¿Deseas eliminar tu cuenta de forma permanente?',
        className: 'vex-theme-default',
        callback: function (value) {
            if(value == true){
                vex.dialog.confirm({
                    message: '¿Eres consciente de todas las futuras consecuencias que conlleva eliminar tu cuenta?',
                    className: 'vex-theme-default',
                    callback: function (value) {
                        if(value == true){
                            vex.dialog.confirm({
                                message: '¿Estás completamente seguro de que quieres eliminar tu cuenta? Esta acción es irreversible',
                                className: 'vex-theme-default',
                                callback: function (value) {
                                    if(value == true){
                                        vex.dialog.open({
                                            message: 'Para confirmar tu identidad, introduce tu contraseña nuevamente:',
                                            className: 'vex-theme-default',
                                            input: [
                                                '<form action="/deleteaccount" method="post">',
                                                '<div>',
                                                    `<input type="hidden" name="_token" value="${token}" />`,
                                                    '<input name="password" type="password" placeholder="Contraseña..." required />',
                                                    '<button type="button" onclick="showPasswordInput()" class="vex-dialog-button vex-first btn-verPassInput" title="Mostrar"></button>',
                                                '</div>',
                                                `<button type="submit" class="vex-dialog-button-primary vex-dialog-button vex-first">Confirmar</button>`,
                                                '<button type="button" class="vex-dialog-button-secondary vex-dialog-button vex-last" onclick="vex.closeAll()">Cancelar</button>',
                                                '</form>'
                                            ].join(''),
                                            buttons: [],
                                            showCloseButton: false,
                                            callback: function (data) {}
                                        })
                                    }
                                }
                            })
                        }
                    }
                })
            }
        }
    })
}

function alertDeletePasswords(token){
    vex.dialog.confirm({
        message: '¿Estás seguro de que quieres resetear tus contraseñas? Esta acción es irreversible.',
        className: 'vex-theme-default',
        input: [
            `<button type="button" class="vex-dialog-button-primary vex-dialog-button vex-first" onclick="alertDeletePasswordsConfirm('${token}')">Confirmar</button>`,
            '<button type="button" class="vex-dialog-button-secondary vex-dialog-button vex-last" onclick="vex.closeAll()">Cancelar</button>'
        ].join(''),
        buttons: [],
        callback: function (value) {}
    })
}
function alertDeletePasswordsConfirm(token){
    vex.dialog.open({
        message: 'Para confirmar tu identidad, introduce tu contraseña nuevamente:',
        className: 'vex-theme-default',
        input: [
            '<form action="/resetpasswords" method="post">',
            '<div>',
                `<input type="hidden" name="_token" value="${token}" />`,
                '<input name="password" type="password" placeholder="Contraseña..." required />',
                '<button type="button" onclick="showPasswordInput()" class="vex-dialog-button vex-first btn-verPassInput" title="Mostrar"></button>',
            '</div>',
            '<button type="submit" class="vex-dialog-button-primary vex-dialog-button vex-first">Aceptar</button>',
            '<button type="button" onclick="vex.closeAll()" class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancelar</button>',
            '</form>'
        ].join(''),
        buttons: [],
        showCloseButton: false,
        callback: function (data) {}
    })
}

function alertAddPass(token){
    vex.dialog.open({
        message: 'Completa los campos para agregar una contraseña:',
        className: 'vex-theme-default',
        input: [
            '<form action="/passwords" method="post">',
            `<input type="hidden" name="_token" value="${token}" />`,
            '<input type="text" name="web" placeholder="Sitio web(Opcional) Ej: www.google.com" />',
            '<input name="name" type="text" placeholder="Nombre | Usuario/Email" required />',
            '<div>',
                '<input name="password" id="input-passGenerada" type="password" placeholder="Contraseña..." required />',
                '<button type="button" onclick="showPasswordInput()" class="vex-dialog-button vex-first btn-verPassInput" title="Mostrar"></button>',
                '<button type="button" onclick="createPassword()" class="vex-dialog-button vex-first btn-generarPass" title="Generar contraseña"></button>',
            '</div>',
            '<button type="submit" class="vex-dialog-button-primary vex-dialog-button vex-first">Aceptar</button>',
            '<button type="button" onclick="vex.closeAll()" class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancelar</button>',
            '</form>'
        ].join(''),
        buttons: [],
        showCloseButton: false,
        callback: function (data) {}
    })
}

function changeUserPic(token){
    vex.dialog.open({
        className: 'vex-theme-default',
        input: [
            '<form action="profile" method="post">',
            `<input type="hidden" name="_token" value="${token}" />`,
            '<label><a href="https://postimages.org/" target="_blank">Sube tu imagen primero aqui (Direct link)</a></label>',
            '<input type="url" name="image" placeholder="Inserte la url aqui" required />',
            '<button type="submit" class="vex-dialog-button-primary vex-dialog-button vex-first">Guardar</button>','<button type="button" onclick="vex.closeAll()" class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancelar</button>',
            '</form>'
        ].join(''),
        buttons: [],
        showCloseButton: false,
        callback: function (data) {}
    })
}

function alertChangePassword(token){
    vex.dialog.open({
        message: 'Completa los campos para cambiar la contraseña',
        className: 'vex-theme-default',
        input: [
            '<form action="/passwordreset" method="post" name="formChangePassword">',
                `<input type="hidden" name="_token" value="${token}" />`,
                '<input name="email" type="email" class="inputChangePassword" placeholder="Ingresa tu email" autofocus required />',
                '<input name="lastpassword" type="password" class="inputChangePassword" placeholder="Contraseña actual" required />',
                '<input name="password" type="password" class="inputChangePassword inputPasswordRegister" placeholder="Contraseña nueva" required />',
                '<input name="password_confirmation" type="password" class="inputChangePassword inputPasswordRegister" placeholder="Verifica contraseña nueva" required />',
                '<div class="d-flex mb-2">',
                '<input type="checkbox" id="seePasswordInputs" class="btn-check"><label class="btn btn-outline-primary" for="seePasswordInputs">Ver contraseñas</label>',
                '<button type="button" id="generateRegisterPassword" class="btn btn-primary ms-3" onclick="generatePassMultipleInputs()">Genera una contraseña</button>',
                '</div>',
            '<button type="submit" class="vex-dialog-button-primary vex-dialog-button vex-first">Aceptar</button>','<button type="button" onclick="vex.closeAll()" class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancelar</button>',
            '</form>'
        ].join(''),
        buttons: [],
        showCloseButton: false,
        callback: function (data) {}
    })
    document.getElementById('seePasswordInputs').addEventListener('click', ()=>{
        let inputs = document.querySelectorAll(".inputChangePassword");
        if(document.getElementById('seePasswordInputs').checked == true){
            inputs.forEach(e => {
                e.type = 'text';
            });
        }
        else{
            inputs.forEach(e => {
                e.type = 'password';
            });
        }
    });
}

function alertEditPass(id, token, web, username, password){
    vex.dialog.open({
        message: 'Edita los campos para actualizar la información:',
        className: 'vex-theme-default',
        input: [
            '<form action="/passwords" method="post">',
            `<input type="hidden" name="_token" value="${token}" />`,
            `<input type="hidden" name="id" id="idCampo" value=${id}>`,
            `<input type="text" name="web" placeholder="Sitio web(Opcional) Ej: www.google.com" value=${web}>`,
            `<input type="text" name="name" placeholder="Nombre | Usuario/Email" value=${username} required>`,
            '<div>',
            `<input name="password" id="input-passGenerada" type="password" placeholder="Contraseña..." value=${password} required />`,
                '<button type="button" onclick="showPasswordInput()" class="vex-dialog-button vex-first btn-verPassInput" title="Mostrar"></button>',
                '<button type="button" onclick="createPassword()" class="vex-dialog-button vex-first btn-generarPass" title="Generar contraseña"></button>',
            '</div>',
            '<button type="submit" class="vex-dialog-button-primary vex-dialog-button vex-first">Guardar</button>','<button type="button" onclick="vex.closeAll()" class="vex-dialog-button-secondary vex-dialog-button vex-last">Cancelar</button>',
            '</form>'
        ].join(''),
        buttons: [],
        callback: function (data) {}
    })
}

