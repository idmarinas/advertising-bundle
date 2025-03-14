# Configuration

> %project% requires that the network and banners be configured to display the ads

> Configuration reference of Bundle
> {style="note"}

```yaml
# config/packages/idm_advertising.yaml
# Default configuration for extension with alias: "idm_advertising"
idm_advertising:
	# Enable/disable Adsense Network.
	adsense:
		enabled: false

		# ID of custom service network.
		service_network: idm_advertising.network.adsense

		# Publisher identification like: ca-pub-XXXXXXX11XXX9
		client: ~ # Required
		banners:

			# Prototype
			name:
				# Select type of banner
				type: display # One of "in-article"; "display"; "search"; "in-feed"; "multiplex"

				# Slot ID of Ad block 8XXXXX1
				slot: ~ # Required

				# Format of Ad
				format: auto # One of "auto"; "rectangle"; "vertical"; "horizontal"; "fluid"

				# Indicate if Ad is responsive, for mobile
				responsive: true

				# Attributes passed to HTML tag (Like "class", "style" ...)
				attributes: ~

	# Enable/disable CpmStar Network.
	cpmstar:
		enabled: false

		# ID of custom service network.
		service_network: idm_advertising.network.cpmstar
		banners:

			# Prototype
			name:

				# Pool ID of Ad block 8XXXXX1
				slot: ~ # Required

				# Attributes passed to HTML tag (Like "class", "style" ...)
				attributes: ~

	# Enable/disable Generic Network.
	generic:
		enabled: false

		# ID of custom service network.
		service_network: null # Required
		banners:
			# Prototype
			name:

				# Slot ID of Ad block
				slot: ~

				# Attributes passed to HTML tag (Like "class", "style" ...)
				attributes: ~

```
