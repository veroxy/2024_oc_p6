<div class="bg-white ">
    <form action="index.php?action=updateFormScript" method="post" class="foldedCorner p-4 d-flex">
        <div class="col-md-6 p-4">
            <fieldset class="mb-3 input-group">
                <label for="thumb">Photo
                <img src="<?= Utils::urlExists($book->getThumb())?: $book->getThumb()?: './views/assets/img/noun-book.png' ?>" alt="<?= $book->getTitle() ?>"
                     class="w-100">
                    <p class="text-end"><a class="link-dark" >modifier la photo</a></p>
                </label>
                <input type="file"
                       accept=".jpg, .jpeg, .png"
                       id="thumb"
                       value="modifier la photo"
                       name="current-thumb"
                       class="form-control invisible">
            </fieldset>
        </div>
        <div class="col-md-6 rounded p-4">
            <fieldset class="mb-3">
                <label for="title">title</label>
                <input type="title"
                       class="form-control"
                       id="title"
                       value="<?= $book->getTitle() ?>"
                       name="current-title"
                       autocomplete="current-title">
            </fieldset>
            <fieldset class="mb-3">
                <label for="author">Auteur</label>
                <input type="text"
                       class="form-control"
                       id="author"
                       value="<?= $book->getAuthors()[0]->getFullname() ?>"
                       autocomplete="current-author"
                       name="current-author">
            </fieldset>
            <fieldset class="mb-3 form-group">
                <label for="content">Commentaire</label>
                <textarea id="content" class="form-control rounded"
                          spellcheck="false" autocorrect="off" autocapitalize="off" name="current-content"
                          autocomplete="current-content" required><?= $book->getContent() ?></textarea>
            </fieldset>
            <fieldset class="mb-3">
                <label for="stock">Stock</label>
                <input type="number"
                       class="form-control"
                       id="stock"
                       min="0"
                       value="<?= $book->getStock() ?>"
                       spellcheck="false"
                       autocorrect="off" autocapitalize="off" name="current-stock"
                       autocomplete="current-stock"
                       readonly\>
            </fieldset>

            <button class="btn btn-primary w-100 py-2" type="submit">Modifier</button>
    </form>
</div>

