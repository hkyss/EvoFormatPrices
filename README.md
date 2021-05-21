# FormatPrices

## Install
- Copy this repo into your site folder
- Create a plugin with code
```php
/**
 * Format prices
 *
 * plugin
 *
 * @category        plugin
 * @version         0.1
 * @author          hkyss
 * @documentation   empty
 * @lastupdate      18.05.2021
 * @internal    	@modx_category Resources
 * @internal    	@events OnDocFormSave
 * @internal    	@properties &tvs=Наименования TV-параметров;string;price &templates=Шаблоны;string;9
 *
 */

include_once MODX_BASE_PATH.'assets/plugins/FormatPrices/plugin.FormatPrices.php';
```
- Set tvs and tpls in configuration tab (comma separator)