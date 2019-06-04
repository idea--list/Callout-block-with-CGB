This project was bootstrapped with [Create Guten Block](https://github.com/ahmadawais/create-guten-block).

Below you will find the steps how it was built.
1. npx create-guten-block callout-cgb
2. apply this fix: https://github.com/ahmadawais/create-guten-block/issues/183
3. npm start
4. Copy & paste code from the non-cgb, plain ES5 version of the plugin's block.js (that works fine)
5. Adding load_plugin_textdomain() and wp_set_script_translations() to src/init.php
6. npm run build to generate distributable .js (__ exposed as expected after applying the fix)
7. md languages
8. wp i18n make-pot ./ languages/callout-cgb.pot --exclude="/js/,/src/block/"    (using wp-cli V2.2)
9. the generated .pot contains both i18n string of build.blocks.js as expected
10. generate .po and .mo files with PoEdit V2.2.3
11. wp i18n make-json callout-cgb-de_DE.po --no-purge
12. rename the .json file to callout-cgb-de_DE-callout_cgb-cgb-block-js.json so that it follows the ${domain}-${locale}-${handle}.json pattern
13. Checking the plugins screen while WP admin is set to german confirms the path provided in the code is ok as the plugin name and description gets translated
14. However the placeholder of the RichText component does not get translated despite the same method works if implemented in pure ES5 and without any dev tools.


I have no clue why this happens...any solution is welcome!
