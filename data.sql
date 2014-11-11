SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `descricao` text CHARACTER SET latin1,
  `valor` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `produtos` VALUES ('1', 'Playstation 4', 'Playstation 4 original à pronta entrega.', '1519.00');
INSERT INTO `produtos` VALUES ('2', 'Xbox One 500 Gb', 'Xbox One 500 Gb Original Microsoft + Kinect + Headset', '1599.00');
INSERT INTO `produtos` VALUES ('3', 'Nitendo Wii Original', 'Nintendo Wii + 6 controles + 3 jogos', '869.00');
INSERT INTO `produtos` VALUES ('4', 'Nintendo Wii Deluxe', 'Nintendo WIi U Deluxe 32 Gb + 2 jogos', '1299.00');
INSERT INTO `produtos` VALUES ('5', 'Geforce GTX Titan', 'Geforce GTX Titan Black 6 Gb - Gddr 5', '4799.00');
INSERT INTO `produtos` VALUES ('6', 'iPad Mini Retina', 'iPad Mini Retina 64 Gb + Wifi', '1799.00');