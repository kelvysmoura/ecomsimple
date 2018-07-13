# ecomsimple

## Instruções para teste em localhost

### Antes de tudo
```
Certifique-se de que está usando um versão PHP >= 5.6.31
Dê o comando composer update para instalar as dependecias
```

### Configurando url base
```php
# Dentro do arquivo constants.php

define('MAIN_URL', 'url-base');
```

### Configurando banco de dados
```php
# Dentro do arquivo constants.php

define('DRIVE', 'mysql');
define('HOST', '');
define('PORT', '');
define('DBNAME', '');
define('USERNAME', '');
DEFINE('PASSWORD', '');

```

### Banco de dados
```sql
CREATE TABLE `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `promotion_active` tinyint(1) NOT NULL DEFAULT 0,
  `promotion_start` timestamp NULL DEFAULT NULL,
  `promotion_end` timestamp NULL DEFAULT NULL,
  `promotion_price` decimal(10,2) unsigned DEFAULT 0.00,
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


-- É important que insira esse registro pois a validação da senha é feita com password_verify()

INSERT INTO `user` VALUES (1,'Admin','Admin','admin@mail.com','$2y$10$w573GZuD3kSh/mqXDqIg6OtYL8Q3KT7MXgHEH09YmkmSePzjbLtza',CURRENT_TIMESTAMP,CURRENT_TiMESTAMP);

```
