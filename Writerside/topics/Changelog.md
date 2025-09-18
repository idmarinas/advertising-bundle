# Changelog

## 2.0.1 - (2025-03-DD)

### Fixed

* _Fixed_ `Quickstart.md` text in Spanish is translated

## 2.0.0 - (2025-03-14)

## Release highlights

This release is mainly focused on setting PHP version `8.2` as the minimum supported version, only Symfony
Framework versions `6.4` and `^7.1` are supported and also Bundle refactoring.

### Added

* _Added_ compatibility with Twig Component. Can use `<twig:IdmAdvertising:Banner network="adsense" banner="main" />`
  and `<twig:IdmAdvertising:Scripts network="adsense" />`
* _Added_ new **Events**
	* `NetworkEvent`
	* `TwigBannerEvent`
	* `TwigScriptsEvent`
* _Added_ new provider for networks **ProviderHub**
* _Added_ Twig Extension `AdvertisingExtension`
	* _Added_ `BannerRuntime` and `ScriptsRuntime` for Twig Extension

### Changed

The whole Bundle is refactored to use more the concept of objects. The new structure is used for Symfony Bundles

* _Changed_ **Networks** and **Banners** are objects now
* _Changed_ Events receive this object and can be manipulated and changed or deleted
* _Changed_ now only three networks are supported: "adsense," "cpmstar" and "generic."
	* All 3 can be customized. The “generic” network is designed to be extended to create a customized network.
* _Changed_ **Twig functions**
	* Rename `advertising_banner` to `idm_advertising_banner`
	* Rename `advertising_scripts` to `idm_advertising_scripts`

### Breaking changes

* _BC_ removed the old Network Provider ` NetworkRegister `
* _BC_ removed the old event `TwigGeneric`
* _BC_ removed the old Twig Extension `AdvertisingGeneric`
