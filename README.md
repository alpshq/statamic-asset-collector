<!-- statamic:hide -->
# Asset Collector

> Collect all used assets

<!-- /statamic:hide -->

This Addon provides a simple way to gather all the assets you used on the current page. 

The **main usage** is to display **image credits** at the bottom of your page. But you can also do everything what you'd normally do with a list of assets.

## Installation

You can install the addon using composer:

```
composer require alpshq/statamic-asset-collector
```
<!-- statamic:hide -->

Alternatively you can install the addon by navigating to [Statamic's marketplace](https://statamic.com/addons/alps/asset-collector) within your Control Panel and searching there for `Asset Collector`.

<!-- /statamic:hide -->

## Usage

There is no configuration or setup needed. Everytime an asset's URL is requested, the asset is memorized.

You can get all these assets by using the `collected_assets` tag:

```antlers
{{ collected_assets }}
    <!-- Do something with your assets. -->
{{ /collected_assets }}
```

### Filter Assets by Type

If you want to get only some of the assets you've used you can use the `collected_assets:some` tag.
The tag supports the following parameters which help you filter the assets you need:

| Parameter Name | Type   | Default Value | Explanation                            |
|----------------|--------|---------------|----------------------------------------|
| `image`        | `bool` | `false`       | Whether or not to included **images**. |
| `svg`          | `bool` | `false`       | Whether or not to included **SVGs**.   |
| `video`        | `bool` | `false`       | Whether or not to included **videos**. |
| `audio`        | `bool` | `false`       | Whether or not to included **audios**. |
| `pdf`          | `bool` | `false`       | Whether or not to included **PDFs**.   |

#### Example Usage with Filters

```antlers
{{ collected_assets:some image="true" }}
    <-- Do something with the images which were placed on the current page -->
{{ /collected_assets:some }}

{{ collected_assets:some image="true" svg="true" }}
    <-- You can also combine filters. -->
{{ /collected_assets:some }}
```

### Example: Display Credits

Display credits at the end of your page for all images placed on the current page.

```antlers
{{ used_assets = {collected_assets:some image="true" svg="true"} }}

{{ if used_assets }}
    <div>
        Image Credits:

        <ul>
            {{ used_assets }}
                <li>
                    <a href="{{ url }}" target="_blank">{{ title | lowercase }}</a>
                    &copy; by
                    <a href="{{ credit_link }}" target="_blank">{{ credit }}</a>
                </li>
            {{ /used_assets }}
        </ul>
    </div>
{{ /if }}
```

## Security

If you encounter any security related issues, please email directly jakub@alps.dev instead of opening an issue. All security related issues will be promptly addressed.

## License

This is commercial software. You may use the package for your sites. Each site requires it's own license.
