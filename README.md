# WP EmailOctopus API

A lightweight WordPress plugin to interface with the [EmailOctopus API](https://emailoctopus.com/?ali=f2cfd160-1bb7-11f0-b807-6f39ebf2966d). The plugin only provides a set of PHP classes to easily
integrate with the [EmailOctopus](https://emailoctopus.com/?ali=f2cfd160-1bb7-11f0-b807-6f39ebf2966d)
email newsletter marketing software

## 🚀 Features

- Clean separation of logic with separate classes for contacts, list, campaigns.
- Follows the same logic structure of the EmailOctopus API.
- Manual class loading from `src/` directory based on your project needs.
- Easy integration with WordPress-based projects.
- No Composer dependency.

## 📂 Folder Structure

```
email-octopus-api-wordpress/
├── email-octopus-api-wordpress.php
├── src/
│   ├── EmailOctopusAPI.class.php
│   └── EmailOctopusContact.class.php
```

(TODO: add more classes)

## 🧩 Usage

1. Define your API key in wp-config.php:

```php
define('EMAILOCTOPUS_API_KEY', 'your-api-key');
```

2. Load the needed classes (see: email-octopus-api-wordpress.php)

3. Use the classes in your own code:

```php
$api = new EmailOctopusContact();
$api->setListId('your-list-id');

$response = $api->create('john@example.com', ['FirstName' => 'John']);
```

(TODO: add more examples)

## 📃 License

MIT License

___

By [Francesco Carlucci](https://francescocarlucci.com/)
