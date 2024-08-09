let senderIdAx = null;
function ftx_getContact(senderIdAx = null) {
    let aside        = document.getElementById("aside-message");
    let listContacts = aside.getElementsByClassName('contact-item')
    let listMsg      = aside.getElementsByClassName('contact-message')
    let messageContainer;

    for (var i = 0; i < listContacts.length; i++) {
        if (listContacts[i].classList.contains('active')) {
            // console.log('celui la: ' + i, listContacts[i].getElementsByTagName('strong')[0].textContent)
            var currActived = listContacts[i];
            senderIdAx      = listContacts[i].id; // TOFIXED V2 supprimer dans le html la valeur de l'id $contact->getId() par getUsername qui est unique aussi et ne permet pas cibler un emplacement
        }
        messageContainer = document.getElementById("contact-message-" + senderIdAx);
        messageContainer.classList.remove("d-none");
        messageContainer.classList.add('active');
        messageContainer.setAttribute("aria-current", true);

        listContacts[i].addEventListener("click", function (e) {
            currActived.classList.remove("active");
            currActived.removeAttribute("aria-current");
            this.classList.add("active");
            this.setAttribute("aria-current", true);

            currActived        = this
            senderIdAx         = this.id;
            var currMsgActived = document.getElementById("contact-message-" + senderIdAx);

            console.info('clicked:', "contact-message-" + senderIdAx, '', senderIdAx);

            if (messageContainer.classList.contains('active')) {
                let tester = document.getElementById("contact-message-" + senderIdAx);
                // var currMsgActived = document.getElementsByClassName('contact-message')[i];
                console.info('clicked:', currMsgActived, tester, senderIdAx);
                currMsgActived.classList.remove("d-none");
                currMsgActived.classList.add("active");
                currMsgActived.setAttribute("aria-current", 'true');

                messageContainer.classList.remove("active");
                messageContainer.classList.add("d-none");
                messageContainer.removeAttribute("aria-current");

            }
            messageContainer = currMsgActived
            console.info('apres: ', messageContainer, currMsgActived, senderIdAx)
        });
    }
console.log('id to send :' + senderIdAx)
    let url = 'index.php?action=getCurrentSender&sender=' + senderIdAx;
    return url;
}