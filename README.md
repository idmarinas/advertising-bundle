<!--suppress HtmlDeprecatedAttribute -->
<div align="center">

# IDMarinas Advertising Bundle

![GitHub release](https://img.shields.io/github/release/idmarinas/advertising-bundle.svg?style=for-the-badge)
![GitHub Release Date](https://img.shields.io/github/release-date/idmarinas/advertising-bundle.svg?style=for-the-badge)

</div>

> Show network ads in your Symfony App. Come with the Adsense Network and Generic network for add your own network.

<br />

<div align="center">

[![Test Suite](https://img.shields.io/github/actions/workflow/status/idmarinas/advertising-bundle/php.yml?branch=2.x&style=for-the-badge&logo=github&logoColor=white&label=Lotgd%20Test%20Suite)][test-suit]
[![Quality Gate Status](https://img.shields.io/sonar/quality_gate/idmarinas_advertising-bundle/2.x?server=https%3A%2F%2Fsonarcloud.io&style=for-the-badge&logo=sonarcloud&logoColor=white)](https://sonarcloud.io/summary/new_code?id=idmarinas_advertising-bundle)
[![Coverage](https://img.shields.io/sonar/coverage/idmarinas_advertising-bundle/2.x?server=https%3A%2F%2Fsonarcloud.io&style=for-the-badge&logo=sonarcloud&logoColor=white)][sonarcloud]
[![Technical Debt](https://img.shields.io/sonar/tech_debt/idmarinas_advertising-bundle/2.x?server=https%3A%2F%2Fsonarcloud.io&style=for-the-badge&logo=sonarcloud&logoColor=white)][sonarcloud]

<br />

![Github commits (since latest release)](https://img.shields.io/github/commits-since/idmarinas/advertising-bundle/latest/2.x?style=for-the-badge)
![GitHub commit activity](https://img.shields.io/github/commit-activity/w/idmarinas/advertising-bundle/2.x?style=for-the-badge)
![GitHub last commit](https://img.shields.io/github/last-commit/idmarinas/advertising-bundle/2.x?style=for-the-badge)

#### Code analysis

[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&branch=2.x&metric=reliability_rating)][sonarcloud]
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&branch=2.x&metric=bugs)][sonarcloud]
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&branch=2.x&metric=security_rating)][sonarcloud]
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&branch=2.x&metric=vulnerabilities)][sonarcloud]
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&branch=2.x&metric=sqale_rating)][sonarcloud]
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&branch=2.x&metric=code_smells)][sonarcloud]
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&branch=2.x&metric=duplicated_lines_density)][sonarcloud]

</div>

> ## 🖖 Support
>
> 🩵 If you like this project, give it a 🌟 and share it with your friends!
>
> [![PayPal.Me - The safer, easier way to pay online!](https://img.shields.io/badge/donate-help_my_projects-ffaa29.svg?style=for-the-badge&logo=paypal&cacheSeconds=86400)](https://www.paypal.me/idmarinas)
> [![Liberapay - Donate](https://img.shields.io/liberapay/receives/IDMarinas.svg?style=for-the-badge&logo=liberapay&cacheSeconds=86400)](https://liberapay.com/IDMarinas/donate)
> [![GitHub Sponsor](https://img.shields.io/badge/Sponsor-ea4aaa?style=for-the-badge&logo=github&logoColor=white)](https://github.com/sponsors/idmarinas)


<br />

# 💾 Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

## 💪 Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require idmarinas/advertising-bundle
```

## 🚫 Applications that don't use Symfony Flex

### Step 1️⃣: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require idmarinas/advertising-bundle
```

### Step 2️⃣: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Idm\Bundle\Advertising\IdmAdvertisingBundle::class => ['all' => true],
];
```

## 🖱️ Tech used in code

![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/idmarinas/advertising-bundle.svg?style=for-the-badge)
[![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![Symfony](https://img.shields.io/badge/symfony-black.svg?style=for-the-badge&logo=symfony&logoColor=white)](https://www.symfony.com)

## 🛠️ Tools used for create this project

![Dependabot](https://img.shields.io/badge/dependabot-025E8C?style=for-the-badge&logo=dependabot&logoColor=white)
[![GitHub Actions](https://img.shields.io/badge/github%20actions-%232671E5.svg?style=for-the-badge&logo=githubactions&logoColor=white)](https://github.com/features/actions)
[![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)](https://www.docker.com)
[![Composer](https://img.shields.io/badge/composer-%238c5530?style=for-the-badge&logo=composer&logoColor=white)](https://getcomposer.org)

## 💬 Social

[![X](https://img.shields.io/badge/Twitter-%23000000.svg?style=for-the-badge&logo=X&logoColor=white)](https://x.com/idmarinas)
[![Discord](https://img.shields.io/badge/Discord-IDMarinas-blue?logo=discord&style=for-the-badge&logoColor=white)](https://discord.gg/FXEZqpF)

[sonarcloud]: https://sonarcloud.io/dashboard?id=idmarinas_advertising-bundle

[test-suit]: https://github.com/idmarinas/advertising-bundle/actions/workflows/php.yml
