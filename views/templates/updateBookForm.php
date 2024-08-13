<div class="bg-white ">
    <form action="index.php?action=updateFormScript" method="post" class="foldedCorner p-4 d-flex">
        <div class="col-md-6 p-4">
            <fieldset class="mb-3 input-group">
                <label for="thumb">photo</label>
                <img src="<?= $book->getThumb() ?? './views/assets/img/noun-book.png' ?>" alt="<?= $book->getTitle() ?>"
                     class="w-100">
                <input type="file" id="thumb" value="modifier la photo" name="current-photo" class="form-control">
            </fieldset>
        </div>
        <div class="col-md-6 rounded p-4">
            <fieldset class="mb-3">
                <label for="title">title</label>
                <input type="title" class="form-control" id="title" value="<?= $book->getTitle() ?>"
                       name="current-title"
                       autocomplete="current-title">
            </fieldset>
            <fieldset class="mb-3 form-group">

                <?php //= $book->getContent() ?><!--"-->

                <label for="content"></label>
                <textarea id="content" class="form-control rounded"
                          spellcheck="false" autocorrect="off" autocapitalize="off" name="current-content"
                          autocomplete="current-content" required><?= $book->getContent() ?></textarea>
            </fieldset>
            <fieldset class="mb-3">
                <label for="stock">stock</label>
                <input type="number" class="form-control" id="stock" min="0" value="<?= $book->getStock() ?>"
                       spellcheck="false"
                       autocorrect="off" autocapitalize="off" name="current-stock"
                       autocomplete="current-stock"
                       readonly\>
            </fieldset>
            <fieldset class="mb-3">
                <label for="author">auteur</label>
                <!--                --><?php // $author = $book->getAuthors()[0] ?>
            </fieldset>

            <button class="btn btn-primary w-100 py-2 btn btn-success" type="submit">Modifier</button>
    </form>
</div>

