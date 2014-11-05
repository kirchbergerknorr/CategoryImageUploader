Kirchbergerknorr CategoryImageUploader
======================================

Workaround to avoid exception '$_FILES array is empty' when assiging products to a category or creating a category with the API.

Inspired by:

* http://stackoverflow.com/questions/9700611/exception-raised-in-varien-file-uploader-when-using-xmlrpc-to-modify-categories
* http://www.magentocommerce.com/bug-tracking/issue/?issue=11597

Installation
------------

Add `require` and `repositories` sections to your composer.json as shown in example below and run `composer update`.

*composer.json example*

```
{
    ...
    
    "repositories": [
        {"type": "git", "url": "https://github.com/kirchbergerknorr/CategoryImageUploader"},
    ],
    
    "require": {
        "kirchbergerknorr/CategoryImageUploader": "*"
    },
    
    ...
}
```

Support
-------

Please [report new bugs](https://github.com/kirchbergerknorr/CategoryImageUploader/issues/new).
