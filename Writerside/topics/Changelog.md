# Changelog

## 2.0.0 - (2025-03-DD)

## Release highlights

This release is mainly focused on setting PHP version `8.2` as the minimum supported version, only Symfony
Framework versions `6.4` and `^7.1` are supported and also Bundle refactoring.

### Added

* Added compatibility with Twig Component. Can use `<twig:IdmAdvertising:Banner network="adsense" banner="main" />`
  and `<twig:IdmAdvertising:Scripts network="adsense" />`
* Added new **Events**
	* `NetworkEvent`
	* `TwigBannerEvent`
	* `TwigScriptsEvent`
* Added new provider for networks **ProviderHub**
* Added Twig Extension `AdvertisingExtension`
	* Added `BannerRuntime` and `ScriptsRuntime` for Twig Extension

### Changed

The whole Bundle is refactored to use more the concept of objects. The new structure is used for Symfony Bundles

* Changed **Networks** and **Banners** are objects now
* Changed Events receive this objects and can manipulate and changed or deleted
* Changed now only 3 networks are supported: "adsense", "cpmstar" and "generic".
	* All 3 can be customized. The “generic” network is designed to be extended to create a customized network.
* Changed **Twig functions**
	* Rename `advertising_banner` to `idm_advertising_banner`
	* Rename `advertising_scripts` to `idm_advertising_scripts`

### Breaking changes

* BC removed old Network Provider `NetworkRegister`
* BC removed old event `TwigGeneric`
* BC removed old Twig Extension `AdvertisingGeneric`
