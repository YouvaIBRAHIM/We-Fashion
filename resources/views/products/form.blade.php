    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="productName">Nom du produit</label>
                <input type="text" class="form-control" id="productName" placeholder="Nom du produit">
            </div>
            <div class="form-group col-md-6">
                <label for="productDescription">Description</label>
                <textarea class="form-control" name="productDescription" id="productDescription" rows="5" placeholder="Description"></textarea>
            </div>
        </div>
        <div class="form-group col-md-6">
            
            <label for="state">État</label>
            <select class="form-control" id="state">
                <option>Default select</option>
            </select>

            <label for="categories">Catégories</label>
            <select class="form-control" id="categories" multiple>
                <option>Default select</option>
            </select>
             
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="decimal" class="form-control" id="price" placeholder="Prix">
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-4">
            <label for="inputState">State</label>
            <select id="inputState" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
            </div>
            <div class="form-group col-md-2">
            <label for="inputZip">Zip</label>
            <input type="text" class="form-control" id="inputZip">
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">
                Check me out
            </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>


    <script>
        new TomSelect('select[multiple]',{plugins:{remove_button:{title: 'Supprimer'}}})
    </script>