<div id="contact-message-<?=  $contact->getId() ?> "
     class="content-message list-group-item
              <?= $senderActive && $senderIsset ? ' active' : ' d-none' ?>
              <?= $senderNew && $loop === 0 ? 'active' : ' d-none' ?>
                    ">
    <div class="container h-100">
        <div>
            <a class=""> GoBack</a>
        </div>
        <header>
            <img src="<?= $contact->getThumb() ?>" alt="" width="32" height="32"
                 class="rounded-circle me-2">
            <strong> <?= $contact->getUsername() ?></strong>
        </header>


        <div class="d-flex flex-column">

            <?php foreach ($messages as $loop => $message) {
                if ($message->getReceiver()->getId() == $_SESSION['uid'] & $message->getSender()->getId() == $contact->getId()) { ?>
                    <div class="message d-flex">
                        <figure class="d-flex flex-column col-6">
                            <div class="d-flex pb-2">
                                <small class="text-muted"><?= Utils::convertDateToFrenchFormat($message->getCreatedAt()) ?> </small>
                            </div>
                            <figcaption>
                                <p class="message-content p-3 rounded-2">
                                    <?= $message->getContent() ?>
                                </p>
                            </figcaption>
                        </figure>

                    </div>
                    <?php
                }

                if ($message->getSender()->getId() == $_SESSION['uid'] & $message->getReceiver()->getId() == $contact->getId()) {
                    ?>
                    <div class="message message-outer d-flex justify-content-end">
                        <figure class="d-flex flex-column col-6">
                            <div class="d-flex align-content-end justify-content-end pb-2">
                                <small class="text-muted"><?= Utils::convertDateToFrenchFormat($message->getCreatedAt()) ?></small>
                            </div>
                            <figcaption>
                                <p class="message-content p-3 rounded-2">
                                    <?= $message->getContent() ?>
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
                        <input type="text" class="invisible" name="receiver"
                               value="<?= $contact->getId() ?>">
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
    </div>
</div>

