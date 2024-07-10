<div class="col-md-6 bg-white rounded">
    <form action="index.php?action=updateFormScript" method="post" class="foldedCorner">

        <fieldset class="mb-3">
            <label for="title">title address</label>
            <input type="title" class="form-control" id="title" value="<?= $book->getTitle() ?>"
                   name="current-title"
                   autocomplete="current-title">
        </fieldset>

        <fieldset class="mb-3 form-group">

            <?php //= $book->getContent() ?><!--"-->

            <label for="content"></label>
            <textarea id="content" class="form-control rounded" value="<?= $book->getContent() ?>"
                      spellcheck="false" autocorrect="off" autocapitalize="off" name="current-content"
                      autocomplete="current-content" required></textarea>
        </fieldset>
        <fieldset class="mb-3">
            <label for="stock">stock</label>
            <input type="number" class="form-control" id="stock" min="1" value="<?= $book->getStock() ?>"
                   spellcheck="false"
                   autocorrect="off" autocapitalize="off" name="current-stock"
                   autocomplete="current-stock"
                   readonly\>
        </fieldset>
        <fieldset class="mb-3">
<!--            --><?php //$book = $book->getAuthors();
//            foreach ($book->getAuthors() as $author) {
//                echo $author->getFullname();
//            }
//            ?>

        </fieldset>

        <button class="btn btn-primary w-100 py-2 btn btn-success" type="submit">Modifier</button>
    </form>
</div>

