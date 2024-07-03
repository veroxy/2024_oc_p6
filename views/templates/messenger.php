<div class="d-flex">
    <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white col-md-4" id="aside-message">
        <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
            <span class="fs-5 fw-semibold">Messagerie </span>
        </a>
        <div class="list-group list-group-flush border-bottom scrollarea">

            <?php foreach ($contacts as $loop => $contact) {
//            if (in_array($message->sender, $contacts)) {
                ?>

                <a href="#"
                   class="contact-item list-group-item list-group-item-action py-3 lh-tight
                             <?= isset($senderId) && $contact->getId() == $senderId ? 'active" aria-current="true' : '' ?><?= $loop === 0 ? 'active" aria-current="true' : '' ?>">

                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <img src="<?= $contact->thumb ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong class="mb-1"><?= $contact->username ?></strong>
                        <small>$message->created_at</small>
                    </div>
                    <!--                    <div class="col-10 mb-1 small">-->
                    <?php //= Utils::limitText( $message->content,5) ?><!--</div>-->
                </a>

                <?php
//            }
            } ?>

        </div>
    </div>
    <?php $contact = $contacts[0]; ?>
    <!--    POUR LE TEST LE CONTACTE EST valeur 0-->
    <div class="d-flex" id="content-message">
        <div class="container h-100">
            <div>
                <a class=""> GoBack</a>
            </div>
            <header>
                <img src="<?= $contact->thumb ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong> <?= $contact->username ?></strong>
            </header>


            <div class="d-flex flex-column">

                <?php foreach ($messages as $loop => $message) {

                    if ($message->receiver->getId() == $_SESSION['idUser'] & $message->sender->getId() == $contact->getId()) {
                        ?>
                        <div class="message d-flex">
                            <figure class="d-flex flex-column col-6">
                                <div class="d-flex pb-2">
                                    <small class="text-muted"><?= Utils::convertDateToFrenchFormat($message->getCreatedAt()) ?> </small>
                                </div>
                                <figcaption>
                                    <p class="message-content p-3 rounded-2">
                                        <?= $message->content ?>
                                    </p>
                                </figcaption>
                            </figure>

                        </div>
                        <?php
                    }

                    if ($message->sender->getId() == $_SESSION['idUser'] & $message->receiver->getId() == $contact->getId()) {
                        ?>
                        <div class="message message-outer d-flex justify-content-end">
                            <figure class="d-flex flex-column col-6">
                                <div class="d-flex align-content-end justify-content-end pb-2">
                                    <small class="text-muted"><?= Utils::convertDateToFrenchFormat($message->getCreatedAt()) ?></small>
                                </div>
                                <figcaption>
                                    <p class="message-content p-3 rounded-2">
                                        <?= $message->content ?>
                                    </p>
                                </figcaption>
                            </figure>
                        </div>

                        <?php
                    }

                } ?>
                <form method="post" name="message-form" action="index.php?action=sendMessage" id="newMsg">
                    <div class="d-flex align-items-stretch">
                        <label class="input-group">
                            <input type="text" class="invisible" name="receiver" value="<?= $contact->getId() ?>">
                            <textarea name="content" class="form-control px-0"
                                      placeholder="Type your message..." rows="1"
                                      data-emoji-input="" data-autosize="true"
                                      style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;">
                            </textarea>
                        </label>
                        <button class="btn btn-icon btn-primary">
                            envoyer
                        </button>
                    </div>
                </form>

            </div>