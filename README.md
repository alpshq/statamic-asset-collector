<!-- statamic:hide -->
# Asset Collector

> Collect all used assets

<!-- /statamic:hide -->

Easily manage and showcase image credits on your website with Asset Credit Collector. This addon helps you collect all assets used on a page, allowing you to display image credits and other information effortlessly. Primarily designed for displaying image credits, Asset Collector can also be used to manage any list of assets on your site.

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
{{ used_assets = { collected_assets:some image="true" svg="true" } }}

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

### Example: Gallery

Generating a gallery or carousel of images used on the page.

```antlers
{{ collected_assets:some image="true" }}
    <!-- Create an image gallery or carousel -->
    <img src="{{ url }}" alt="{{ alt }}" title="{{ title }}" />
{{ /collected_assets:some }}
```

### Example: A List of Downloadable Files

Displaying a list of downloadable files (e.g., PDFs or other documents) used on the page.

```antlers
<ul>
    {{ collected_assets:some pdf="true" }}
        <li><a href="{{ url }}" download>{{ title }}</a></li>
    {{ /collected_assets:some }}
</ul>
```

## Security

If you encounter any security related issues, please email directly jakub@alps.dev instead of opening an issue. All security related issues will be promptly addressed.

## License

This is commercial software. You may use the package for your sites. Each site requires its own license.
