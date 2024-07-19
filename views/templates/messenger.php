<div class="d-flex container-fluid">
    <aside class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white col-md-4" id="aside-message">
        <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
            <span class="fs-5 fw-semibold">Messagerie </span>
        </a>
        <div class="list-group list-group-flush border-bottom scrollarea">

            <?php
            if (isset($sender) && !in_array($sender, $contacts)) {
                ?>
                <a href="#" id="<?= $sender->getId() ?>"
                   class="contact-item list-group-item list-group-item-action py-3 lh-tight
                             <?= isset($sender) && $sender->getId() ? 'active" aria-current="true' : '' ?>
">

                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <img src="<?= $sender->getThumb() ?>" alt="<?= $sender->getUsername() ?>" width="32" height="32"
                             class="rounded-circle me-2">
                        <strong class="mb-1"><?= $sender->getUsername() ?></strong>
                        <!--                        <small>$message->created_at</small>-->
                    </div>
                    <!--                    <div class="col-10 mb-1 small">-->
                    <?php //= Utils::limitText( $message->content,5) ?><!--</div>-->
                </a>

                <?php
            }
            ?>

            <?php
            foreach ($contacts as $loop => $contact) {

                if (isset($sender) && in_array($sender, $contacts) && $contact->getId() == $sender->getId()) {
                    $senderActive = true;
                }
                /*  if (isset($sender)) {
                      if ($contact->getId() == $sender->getId()) {
                          if (in_array($sender, $contacts)) {
                              $senderActive = true;
                          }
                      }
                  }*/
                ?>

                <a id="<?= $contact->getId() ?>" href="#"
                   class="contact-item list-group-item list-group-item-action py-3 lh-tight
                    <?= isset($senderActive) && $contact->getId() == $sender->getId() ? ' active" aria-current="true' : '' ?>
                    <?= !isset($sender) && $loop === 0 ? 'active" aria-current="true' : '' ?>
                    ">

                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <img src="<?= $contact->getThumb() ?>" alt="<?= $contact->getUsername() ?>" width="32"
                             height="32"
                             class="rounded-circle me-2">
                        <strong class="mb-1"><?= $contact->getUsername() ?></strong>
                        <small>$message->created_at</small>
                    </div>
                    <!--                    <div class="col-10 mb-1 small">-->
                    <?php //= Utils::limitText( $message->content,5) ?><!--</div>-->
                </a>

                <?php
//            }
            } ?>

        </div>
    </aside>

    <div class="d-flex list-group">
        <?php
        if (isset($sender) && !in_array($sender, $contacts)) {
            $senderActive = true;
            var_dump("fucker");
            ?>
            <div  id="contact-message-<?= $sender->getId() ?>"
                  class="content-message list-group-item
              <?= isset($senderActive) ? ' active' : '' ?>
                    ">
                <div class="container h-100">
                    <div>
                        <a class=""> GoBack</a>
                    </div>
                    <header>
                        <img src="<?= $sender->getThumb() ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong> <?= $sender->getUsername() ?></strong>
                    </header>


                    <div class="d-flex flex-column">

                        <form method="post" name="message-form" action="index.php?action=sendMessage" id="newMsg">
                            <div class="d-flex align-items-stretch">
                                <label class="input-group">
                                    <input type="text" class="invisible" name="receiver" value="<?= $sender->getId() ?>">
                                    <textarea name="content" class="form-control px-0"
                                              placeholder="Type your message..." rows="1"
                                              data-emoji-input="" data-autosize="true"
                                              style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;"></textarea>
                                </label>
                                <button class="btn btn-icon btn-primary">
                                    envoyer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
        }
        foreach ($contacts as $loop => $contact) {
            if (isset($sender) && in_array($sender, $contacts) && $contact->getId() == $sender->getId()) {
                $senderActive = true;
            }
            ?>
            <!--    POUR LE TEST LE CONTACTE EST valeur 0-->
            <div id="contact-message-<?= $contact->getId() ?>"
                 class="content-message d-none list-group-item
              <?= isset($senderActive) && $contact->getId() == $sender->getId() ? ' active' : '' ?>
                    <?= !isset($sender) && $loop === 0 ? 'active' : '' ?>
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
                            if ($message->getReceiver()->getId() == $_SESSION['idUser'] & $message->getSender()->getId() == $contact->getId()) { ?>
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

                            if ($message->getSender()->getId() == $_SESSION['idUser'] & $message->getReceiver()->getId() == $contact->getId()) {
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
                                              style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 47px;"></textarea>
                                </label>
                                <button class="btn btn-icon btn-primary">
                                    envoyer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
