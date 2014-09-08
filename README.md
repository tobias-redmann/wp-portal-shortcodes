WP Portal Shortcodes
====================

Set of shortcodes to add some portal navigation feature


## Category-based Sitemap

With this shortcode you can build a sitemap grouped by categories.

### Usage

	[category_sitemap/]
	
### Parameters

**`header`**  
(default: `h3`) Tag for headings

**`header_class`**  
(defaukt: `''`) Class for heading, when empty string no class output will be generated

**`list`**  
(default: `ul`) Tag for list of posts

**`list_class`**  
(default: `''`) Class for list, when empty string no class output will be generated

**`item`**  
(default: `li`) Tag for list items

**`item_class`**  
(default: `''`) Class for list items, when empty string no class will be generated

**`exclude`**  
(default: `''`) Comma-seperated list of category ids to exclude

**`hide_empty`**  
(default: `1`) Whether to show empty categories true (1) or false (0) 

**`orderby`**  
(default: `'name'`) Order key for category orderung. Available keys: id, name, slug, count 

**`order`**  
(default: `asc`) Sort order. Values: asc, desc regarding to `orderby`



### Example 1

	[category_sitemap/]
	
Will generate something like

    <h3><a href="/my-category/">My Category</a></h3>
    <ul>
      <li><a href="/my-categpry/post-1/">Post 1</a></li>
      <li><a href="/my-categpry/post-2/">Post 2</a></li>
    </ul>
    
    <h3><a href...


### Example 2

	[category header="h2" list="div" list_class="sitemap_list" item="h3"]
	
Will generate something like

    <h2><a href="/my-category/">My Category</a></h2>
    
    <div class="sitemap_list">
      <h3><a href="/my-categpry/post-1/">Post 1</a></h3>
      <h3><a href="/my-categpry/post-2/">Post 2</a></h3>
    </div>
    
    <h2><a href...

### Contact

More Information needed, just go to [https://www.tricd.de](https://www.tricd.de)