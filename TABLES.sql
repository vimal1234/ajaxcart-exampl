CREATE TABLE IF NOT EXISTS `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;


INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'View Sonic LCD', '19" View Sonic Black LCD, with 10 months warranty', '320', 'images/lcd.jpg'),
(3, 'Conwood Luggage Orange', 'This bag is cool and can be used for all occassions as wished', '90', 'images/wnaFA_Conwood_Soft_Trolley_Case_Luggage_Orange.jpg'),
(4, 'Xmas Flowers and Fruits', 'Our Christmas flowers & gift have always been about offering fresh flowers in a variety of beautiful baskets to suit your personal and corporate gifting needs. Get into the merry spirit of giving and sharing with family, friends, and business associates with our flower, fruit & toiletries gifts. ', '99', 'images/christmasflowersandgifts.jpg'),
(5, 'Atech Mouse', 'Black colored laser mouse at affordable price and warranty', '17', 'images/mouse.jpg'),
(2, 'Latin/Salsa Dance shoes', 'This shoes comes with gold heels. It will look more elegant. Can be worn for special occasions.', '88', 'images/Latin_and_Salsa_Dance_shoes.jpg');


CREATE TABLE IF NOT EXISTS `products_added` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `item_added` varchar(200) NOT NULL,
  `price` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `products_bought` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(200) NOT NULL,
  `item_names` varchar(200) NOT NULL,
  `prices` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;