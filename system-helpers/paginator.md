#**From v3.73.3 this has been removed**

Break recordset into a series of pages.

First create a new instance of the class pass in the number of items per page and the instance identifier, this is used for the GET parameter such as ?p=2

The setTotal method expects the total number of records, either set this or pass in a call to a model that will return records then count them on return.

The method used to get the records will need a getLimit passed to it, this will then return the set number of records for that page.

Lastly a method called page_links will return the page links.

The model that uses the limit will need to expect the limit:

```php
public function getContacts($limit)
{
    return $this->db->select('
        SELECT 
        *,
        (SELECT count(id) FROM '.PREFIX.'contacts) as total
     FROM '.PREFIX.'contacts '.$limit);
}
```

**Pagination concept**

```php
//create a new object
$pages = new Paginator('1', 'p');

//calling a method to get the records with the limit set (model would be the var holding the model data)
$data['records'] = $this->model->getContacts($pages->getLimit());

//set the total records, calling a method to get the number of records from a model
$pages->setTotal($data['records'][0]->total);

//create the nav menu
$data['pageLinks'] = $pages->pageLinks();
```

**Usage example:**

```php
$pages = new Paginator('50','p');
$data['records'] = $this->model->getContacts($pages->getLimit());
$pages->setTotal($data['records'][0]->total);  
$data['pageLinks'] = $pages->pageLinks();
```
