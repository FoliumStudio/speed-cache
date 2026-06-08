# Plugin Check Report

**Plugin:** Speed Cache
**Generated at:** 2026-06-08 13:58:23


## `lib/Optimisationio/CacheEnabler.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 296 | 9 | ERROR | WordPress.WP.AlternativeFunctions.unlink_unlink | unlink() is discouraged. Use wp_delete_file() to delete a file. |  |
| 309 | 40 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 332 | 68 | ERROR | PluginCheck.CodeAnalysis.WriteFile.PluginDirectoryWrite | Plugin folders are deleted when upgraded. Do not save data to the plugin folder using copy(). Detected usage of constant WP_CONTENT_DIR. Use wp_upload_dir() to get the uploads directory path or save to the database instead. |  |
| 390 | 48 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_is_writable | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: is_writable(). |  |
| 417 | 20 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_fopen | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: fopen(). |  |
| 419 | 18 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_fwrite | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: fwrite(). |  |
| 419 | 25 | WARNING | PluginCheck.CodeAnalysis.WriteFile.ABSPATHDetected | Writing files using ABSPATH may be problematic. Consider using wp_upload_dir() instead if storing user data or generated files. |  |
| 422 | 14 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_fclose | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: fclose(). |  |
| 438 | 40 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 513 | 16 | WARNING | WordPress.DB.DirectDatabaseQuery.DirectQuery | Use of a direct database call is discouraged. |  |
| 513 | 16 | WARNING | WordPress.DB.DirectDatabaseQuery.NoCaching | Direct database call without caching detected. Consider using wp_cache_get() / wp_cache_set() or wp_cache_delete(). |  |
| 576 | 34 | ERROR | WordPress.WP.I18n.MissingTranslatorsComment | A function call to __() with texts containing placeholders was found, but was not accompanied by a "translators:" comment on the line above to clarify the meaning of the placeholders. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#descriptions) |
| 576 | 34 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '__'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 576 | 37 | ERROR | WordPress.WP.I18n.UnorderedPlaceholdersText | Multiple placeholders in translatable strings should be ordered. Expected "%1$s, %2$s", but got "%s, %s" in 'The %s plugin requires a custom permalink structure to start caching properly. Please go to Permalink to enable it.'. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#variables) |
| 576 | 217 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'admin_url'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 612 | 21 | ERROR | WordPress.WP.I18n.MissingArgDomain | Missing $domain parameter in function call to esc_html__(). | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 724 | 58 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;user_can_clear_cache&quot;. |  |
| 771 | 60 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_GET[&#039;_wpnonce&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 771 | 60 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_GET[&#039;_wpnonce&#039;] |  |
| 776 | 58 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;user_can_clear_cache&quot;. |  |
| 884 | 58 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;user_can_clear_cache&quot;. |  |
| 1068 | 86 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_POST[&#039;_cache__status_nonce_&#039; .$post_ID] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1068 | 86 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_POST[&#039;_cache__status_nonce_&#039; .$post_ID] |  |
| 1190 | 25 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_SERVER[&#039;SCRIPT_NAME&#039;]. Check that the array index exists before using it. |  |
| 1190 | 25 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;SCRIPT_NAME&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 1190 | 25 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;SCRIPT_NAME&#039;] |  |
| 1204 | 25 | ERROR | WordPress.WP.DiscouragedConstants.TEMPLATEPATHUsageFound | Found usage of constant "TEMPLATEPATH". Use get_template_directory() instead. |  |
| 1204 | 60 | ERROR | WordPress.WP.DiscouragedConstants.TEMPLATEPATHUsageFound | Found usage of constant "TEMPLATEPATH". Use get_template_directory() instead. |  |
| 1204 | 98 | ERROR | WordPress.WP.DiscouragedConstants.TEMPLATEPATHUsageFound | Found usage of constant "TEMPLATEPATH". Use get_template_directory() instead. |  |
| 1204 | 133 | ERROR | WordPress.WP.DiscouragedConstants.TEMPLATEPATHUsageFound | Found usage of constant "TEMPLATEPATH". Use get_template_directory() instead. |  |
| 1252 | 28 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;bypass_cache&quot;. |  |
| 1275 | 22 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 1275 | 41 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 1275 | 62 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 1275 | 83 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 1325 | 13 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;cache_minify_ignore_tags&quot;. |  |
| 1529 | 13 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$available_options[$current_action]'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 1530 | 13 | ERROR | WordPress.WP.I18n.MissingArgDomain | Missing $domain parameter in function call to esc_html__(). | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 1531 | 13 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$dropdown_options'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 1532 | 13 | ERROR | WordPress.WP.I18n.MissingArgDomain | Missing $domain parameter in function call to esc_html__(). | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 1533 | 13 | ERROR | WordPress.WP.I18n.MissingArgDomain | Missing $domain parameter in function call to esc_html__(). | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 1612 | 25 | ERROR | WordPress.WP.I18n.MissingTranslatorsComment | A function call to __() with texts containing placeholders was found, but was not accompanied by a "translators:" comment on the line above to clarify the meaning of the placeholders. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#descriptions) |
| 1612 | 28 | ERROR | WordPress.WP.I18n.UnorderedPlaceholdersText | Multiple placeholders in translatable strings should be ordered. Expected "%1$s, %2$s", but got "%s, %s" in 'The %s is optimized for WordPress %s. Please disable the plugin or upgrade your WordPress installation (recommended).'. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#variables) |
| 1621 | 58 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_is_writable | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: is_writable(). |  |
| 1626 | 25 | ERROR | WordPress.WP.I18n.MissingTranslatorsComment | A function call to __() with texts containing placeholders was found, but was not accompanied by a "translators:" comment on the line above to clarify the meaning of the placeholders. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#descriptions) |
| 1626 | 28 | ERROR | WordPress.WP.I18n.UnorderedPlaceholdersText | Multiple placeholders in translatable strings should be ordered. Expected "%1$s, %2$s, %3$s, %4$s", but got "%s, %s, %s, %s" in 'The %s requires write permissions %s on %s. Please change the permissions.'. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#variables) |
| 1643 | 25 | ERROR | WordPress.WP.I18n.MissingTranslatorsComment | A function call to __() with texts containing placeholders was found, but was not accompanied by a "translators:" comment on the line above to clarify the meaning of the placeholders. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#descriptions) |
| 1643 | 28 | ERROR | WordPress.WP.I18n.UnorderedPlaceholdersText | Multiple placeholders in translatable strings should be ordered. Expected "%1$s, %2$s", but got "%s, %s" in 'The %s plugin is already active. Please disable minification in the %s settings.'. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#variables) |

## `optimisationio.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 119 | 33 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;plugin_locale&quot;. |  |
| 175 | 13 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'self'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 177 | 13 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$this'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 190 | 13 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'self'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 191 | 13 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$this'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |

## `views/sidebar.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |
| 11 | 110 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'plugins_url'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 16 | 101 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'plugins_url'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 21 | 86 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'plugins_url'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |

## `lib/Optimisationio/Admin.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 27 | 13 | WARNING | WordPress.WP.EnqueuedResourceParameters.MissingVersion | Resource version not set in call to wp_enqueue_style(). This means new versions of the style may not always be loaded due to browser caching. |  |
| 44 | 14 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'Optimisationio_View'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 44 | 57 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$data'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 77 | 21 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '__'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 86 | 14 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'Optimisationio_View'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 86 | 59 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$data'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 118 | 17 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$msg'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 123 | 17 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$msg'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |

## `advanced-cache.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 9 | 14 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 9 | 33 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 9 | 54 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 9 | 75 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 15 | 27 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$k&quot;. |  |
| 15 | 33 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$v&quot;. |  |
| 23 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$host&quot;. |  |
| 23 | 63 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;HTTP_HOST&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 23 | 63 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;HTTP_HOST&#039;] |  |
| 24 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$host&quot;. |  |
| 27 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$uri_path&quot;. |  |
| 28 | 46 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;REQUEST_URI&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 28 | 46 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;REQUEST_URI&#039;] |  |
| 50 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$path_html&quot;. |  |
| 51 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$path_gzip&quot;. |  |
| 52 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$path_webp_html&quot;. |  |
| 53 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$path_webp_gzip&quot;. |  |
| 62 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$headers&quot;. |  |
| 63 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$http_if_modified_since&quot;. |  |
| 64 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$http_accept&quot;. |  |
| 65 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$http_accept_encoding&quot;. |  |
| 67 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$http_if_modified_since&quot;. |  |
| 67 | 81 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;HTTP_IF_MODIFIED_SINCE&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 67 | 81 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;HTTP_IF_MODIFIED_SINCE&#039;] |  |
| 68 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$http_accept&quot;. |  |
| 68 | 59 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;HTTP_ACCEPT&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 68 | 59 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;HTTP_ACCEPT&#039;] |  |
| 69 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$http_accept_encoding&quot;. |  |
| 69 | 77 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;HTTP_ACCEPT_ENCODING&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 69 | 77 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;HTTP_ACCEPT_ENCODING&#039;] |  |
| 74 | 11 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_SERVER[&#039;SERVER_PROTOCOL&#039;]. Check that the array index exists before using it. |  |
| 74 | 11 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;SERVER_PROTOCOL&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 74 | 11 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;SERVER_PROTOCOL&#039;] |  |
| 82 | 4 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_readfile | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: readfile(). |  |
| 85 | 4 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_readfile | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: readfile(). |  |
| 93 | 3 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_readfile | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: readfile(). |  |
| 98 | 2 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_readfile | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: readfile(). |  |

## `lib/Optimisationio/CdnRewrite.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 123 | 33 | ERROR | WordPress.WP.AlternativeFunctions.parse_url_parse_url | parse_url() is discouraged because of inconsistency in the output across PHP versions; use wp_parse_url() instead. |  |
| 250 | 22 | ERROR | WordPress.WP.AlternativeFunctions.parse_url_parse_url | parse_url() is discouraged because of inconsistency in the output across PHP versions; use wp_parse_url() instead. |  |

## `lib/Optimisationio/CacheEnablerDisk.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 167 | 4 | ERROR | WordPress.WP.AlternativeFunctions.unlink_unlink | unlink() is discouraged. Use wp_delete_file() to delete a file. |  |
| 168 | 4 | ERROR | WordPress.WP.AlternativeFunctions.unlink_unlink | unlink() is discouraged. Use wp_delete_file() to delete a file. |  |
| 169 | 4 | ERROR | WordPress.WP.AlternativeFunctions.unlink_unlink | unlink() is discouraged. Use wp_delete_file() to delete a file. |  |
| 170 | 4 | ERROR | WordPress.WP.AlternativeFunctions.unlink_unlink | unlink() is discouraged. Use wp_delete_file() to delete a file. |  |
| 193 | 82 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;HTTP_IF_MODIFIED_SINCE&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 193 | 82 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;HTTP_IF_MODIFIED_SINCE&#039;] |  |
| 194 | 60 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;HTTP_ACCEPT&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 194 | 60 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;HTTP_ACCEPT&#039;] |  |
| 195 | 78 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;HTTP_ACCEPT_ENCODING&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 195 | 78 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;HTTP_ACCEPT_ENCODING&#039;] |  |
| 200 | 12 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotValidated | Detected usage of a possibly undefined superglobal array index: $_SERVER[&#039;SERVER_PROTOCOL&#039;]. Check that the array index exists before using it. |  |
| 200 | 12 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;SERVER_PROTOCOL&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 200 | 12 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;SERVER_PROTOCOL&#039;] |  |
| 208 | 5 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_readfile | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: readfile(). |  |
| 211 | 5 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_readfile | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: readfile(). |  |
| 219 | 4 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_readfile | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: readfile(). |  |
| 224 | 3 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_readfile | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: readfile(). |  |
| 312 | 21 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_fopen | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: fopen(). |  |
| 317 | 4 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_fwrite | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: fwrite(). |  |
| 318 | 3 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_fclose | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: fclose(). |  |
| 325 | 4 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_chmod | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: chmod(). |  |
| 367 | 5 | ERROR | WordPress.WP.AlternativeFunctions.unlink_unlink | unlink() is discouraged. Use wp_delete_file() to delete a file. |  |
| 372 | 4 | ERROR | WordPress.WP.AlternativeFunctions.file_system_operations_rmdir | File operations should use WP_Filesystem methods instead of direct PHP filesystem calls. Found: rmdir(). |  |
| 437 | 63 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;HTTP_HOST&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 437 | 63 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;HTTP_HOST&#039;] |  |
| 440 | 80 | WARNING | WordPress.Security.ValidatedSanitizedInput.MissingUnslash | $_SERVER[&#039;REQUEST_URI&#039;] not unslashed before sanitization. Use wp_unslash() or similar |  |
| 440 | 80 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_SERVER[&#039;REQUEST_URI&#039;] |  |
| 555 | 14 | ERROR | WordPress.WP.AlternativeFunctions.parse_url_parse_url | parse_url() is discouraged because of inconsistency in the output across PHP versions; use wp_parse_url() instead. |  |
| 601 | 14 | ERROR | WordPress.WP.AlternativeFunctions.parse_url_parse_url | parse_url() is discouraged because of inconsistency in the output across PHP versions; use wp_parse_url() instead. |  |

## `readme.txt`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | outdated_tested_upto_header | Tested up to: 6.7 < 7.0. The "Tested up to" value in your plugin is not set to the current version of WordPress. This means your plugin will not show up in searches, as we require plugins to be compatible and documented as tested up to the most recent version of WordPress. | [Docs](https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/#readme-header-information) |
| 0 | 0 | WARNING | mismatched_plugin_name | Plugin name "Speed Cache – Caching, CDN & DB Optimisation" is different from the name declared in plugin header "Speed Cache". | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#incomplete-readme) |

## `views/header.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |
| 21 | 24 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |
| 21 | 73 | WARNING | WordPress.Security.NonceVerification.Recommended | Processing form data without nonce verification. |  |

## `views/cache_enabler.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `views/cdn_enabler.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |
