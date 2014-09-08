<?php 
  require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/application.php'); 
  include ROOT . "app/assets/includes/card_header.php"; 

  $webroot = WEB_ROOT;
?>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>
        id
      </th>
      <th>
        name
      </th>
      <th>
        prefix
      </th>
      <th>
        number of cards
      </th>
      <th>
        actions
      </th>
    </tr>
  </thead>
  <tbody>
<?php
  foreach ($sets as $id => $set) {
    echo <<<HTML
    <tr>
      <td>$set->id</td>
      <td>$set->name</td>
      <td>$set->prefix</td>
      <td>TODO</td>
      <td>
        <a class="btn btn-default" href="{$webroot}card-maker/sets/add_card/{$set->id}">
          <i class="glyphicon glyphicon-plus"></i> Add Card
        </a>
        <a class="btn btn-primary" href="{$webroot}card-maker/sets/show/{$set->id}">View</a>
        <a class="btn btn-success" href="{$webroot}card-maker/sets/edit/{$set->id}">Edit</a>
        <a class="btn btn-danger" href="{$webroot}card-maker/sets/delete/{$set->id}">Delete</a>
        <a class="btn btn-warning" href="{$webroot}card-maker/sets/download/?setId={$set->id}">Download</a>
      </td>
    </tr>

HTML;
  }
?>
  </tbody>
</table>
</div>
</div>
<?php 
  include ROOT . "app/assets/includes/card_footer.php"; 
?>