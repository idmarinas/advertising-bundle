# Quickstart

<secondary-label ref="2.0.0" />

This is a quick way to start using the %project% in your project.
{id="summary"}

## Before you start

> Follow the [](Installation.md) guide

### Configuration

#### Step 1

> Create the configuration of advertising for your project. This is an example:

```yaml
# config/packages/idm_advertising.yaml
idm_advertising:
	adsense:
		enabled: true
		service_network: idm_advertising.network.adsense
		client: ca-pub-XXXXXXX11XXX9
		banners:
			main:
				type: display
				slot: 8874563151
				format: auto
				responsive: true
				attributes:
					class: 'mx-auto'

			search:
				type: search
				slot: 7895433148
				attributes:
					style: 'display:block;'
					class: 'w-full h-full'

			home:
				type: in-feed
				slot: 87945613588522
				attributes:
					layout-in-feed: '-6t+ed+2i-1n-4w'
```

#### Step 2

> In your `base.html.twig` add the following line:

```twig
<!DOCTYPE html>
<html>
	<head>
		<!-- ... -->
	</head>
	<body>	
		<!-- Your other content -->
		
		<!-- Add one of the two forms just before </body>. -->
		
		<!-- Syntax of Twig Function -->
		{{ idm_advertising_scripts() }}
		
		<!-- You can also use the syntax of Twig Component -->
		<twig:IdmAdvertising:Scripts />
	</body>
</html>
```

### Showing banners

> When you want to add a banner to a page you can use one of the following two methods
> {style="note"}

#### Twig Function

```twig
{{ idm_advertising_banner('adsense', 'main') }}
```

#### Twig Components

```twig
<twig:IdmAdvertising:Banner network="adsense" banner="home" />
```
