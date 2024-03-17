/**
 * Il nous faut une fonction pour récupérer le JSON 
 * des messages et les afficher correctement
 */

function getMessages() {
    // 1. Elle doit créer une requete AJAX pour se connecter au serveur, et notamment au fichier Ajax.php
        const requeteAjax = new XMLHttpRequest();
        requeteAjax.open("GET", "Ajax.php");
    // 2. Quand elle recoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut
    // qu'il affiche ces données au format HTML
        requeteAjax.onload = function(){
            const resultat = JSON.parse(requeteAjax.responseText);
            
            const html = resultat.reverse().map(function(message){
                    return `
                        <div class="message">
                            <div class="chat-body">						
                                <div class="chat-message messages"> 
                                    <span class="date">${message.created_at}</span>							
                                    <h5 class="author">${message.author}</h5> 							
                                    <p class="content">${message.content}</p> 						
                                </div> 				
                            </div> 
                        </div>
                    `
            }).join('');
            const messages = document.querySelector('.messages');

            messages.innerHTML = html;
            messages.scrollTop = messages.scrollHeight;
        }
    // 3. On envoie la requete
        requeteAjax.send();
}

function postMessage(event) {
    // 1. Elle doit stopper le submit du formulaire
        event.preventDefault();
    // 2. Elle doit récuperer les données du formulaire
        const author = document.querySelector('#author');
        const content = document.querySelector('#content');
    // 3. Elle doit conditionner les données
        const data = new FormData();
        data.append('author', author.value);
        data.append('content', content.value);
    // 4. Elle doit configurer une requete AJAX en POST et envoyer les données
        const requeteAjax = new XMLHttpRequest();
        requeteAjax.open('POST', 'Ajax.php?task=write');

        requeteAjax.onload = function(){
            content.value = '';
            content.focus();
            getMessages();
        }

        requeteAjax.send(data);
}
document.querySelector('form').addEventListener('submit', postMessage);

const interval = window.setInterval(getMessages, 3000);

getMessages();