<form class="form-inline ml-3" method="get" action="/employees">

    <div class="input-group input-group-sm mr-3">
        <?php $searchTerm = app('request')->filled('search') ? app('request')->input('search')  : '';  ?>
        <input class="form-control form-control-navbar" id="global-search" name="search" type="search" value="<?php echo $searchTerm ?>" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div class="input-group input-group-sm">
        <a href="#" class="btn btn-sm btn-primary">Advanced Search</a>
    </div>

</form>
