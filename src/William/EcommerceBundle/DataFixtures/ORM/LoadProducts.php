<?php

namespace William\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use William\EcommerceBundle\Entity\Product;

class LoadProducts extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		// $directory = './../../../../../web/img/product/';
		$demo_values = $this->getDemoValues();

		for($i = 0; $i < count($demo_values['title']); $i++)
		{
			$products[$i] = new Product();
			
			$products[$i]->setTitle($demo_values['title'][$i]);

			// Attribue une marque aléatoire, parmis les 7 disponibles
			$products[$i]->setBrand($this->getReference((string)rand(0, 6).'-brand'));

			// On selectionne quelques catégories, au hazard (entre 1 et 4)
			$index_category = range(0, 27);
			shuffle($index_category);
			for($j=0; $j<rand(1, 4); $j++){
				$products[$i]->addCategory($this->getReference((string)$index_category[$j].'-category'));
			}

			$products[$i]->setdescription($demo_values['description'][$i]);

			// On en profite pour stoker les images en local
			$image_path = 'web/img/product/'.basename($demo_values['photo'][$i]);
			$web_image_path = 'img/product/'.basename($demo_values['photo'][$i]);
			if(!file_exists($image_path))
			{
				file_put_contents($image_path, file_get_contents($demo_values['photo'][$i]));
			}
			$products[$i]->setPhoto($web_image_path);

			// Donne un prix aléatoire entre 0 et 100€
			$products[$i]->setPrice(number_format(rand(0, 10000) / 100, 2));
			$products[$i]->setcreationdate(new \DateTime());

			// 1 stock sur 5 sera considéré comme "épuisé"
			if(rand(0, 5) == 1) $products[$i]->setStock(false);
			else $products[$i]->setStock(true);

			$manager->persist($products[$i]);
		}
		$manager->flush();
	}

	public function getOrder()
    {
        return 3;
    }


    private function getDemoValues()
    {
		$values['title'] = array("Nike 3-Pack Quarter Running Socks",
							"Hilly Mono Skin Lite Anklet GB Running Socks",
							"Nike 3 Pack Crew Running Socks",
							"ASICS Volt Run 5 Inch Baggy Short",
							"ASICS Volt Run Short Sleeve Running T-Shirt",
							"Nike Cushioned Dynamic Arch Anklet Running Socks",
							"ASICS Volt Run Long Running Tights",
							"Nike Pro Women's 3 Inch Compression Running Shorts - SP14",
							"Saucony River 3 pack Anklet Socks",
							"Saucony 3 Pair Women's Anklet Running Socks",
							"ASICS LADY VESTA Knee Length Capri Running Tights",
							"ASICS LOGO PERFORMANCE Long Sleeve Running Top",
							"ASICS Volt Run 7 Inch Baggy Short",
							"Ronhill Classic GT Trackster Running Pants",
							"Saucony 3 Pair Anklet Running Socks",
							"Hilly Supreme Running Gloves",
							"ASICS Volt Run Short Sleeve Running T-Shirt",
							"Nike Dri-Fit Half-Cushion Quarter Running Socks",
							"Puma FAAS Tech Gore Windstopper Running Jacket",
							"Hilly Mono Skin Sport Anklet (Twin Pack) Running Socks",
							"Nike Flash Reversible Running Gilet",
							"Nike Equip Cushioned Crew 6 Pack Running Socks",
							"Nike Dri-Fit No Show Running Socks (3 Packs)",
							"Ronhill Classic GT Trackster Running Pants",
							"Under Armour Lady Tech Short Sleeve Running T-Shirt",
							"Nike Swift Running Gloves",
							"ASICS Volt Run Short Tight",
							"ASICS Volt Run Long Sleeve Half-Zip Running Top",
							"Nike Victory Contour Women's Support Sports Bra",
							"Asics Performance Logo Short Sleeved Running T-Shirt",
							"Nike Pro Vapor Long Sleeve Compression Running Top",
							"Under Armour 'The Original' 6 Inch Boxer Shorts",
							"Nike 6 Pack Running Socks",
							"Skins Bio Snow Compression Running Tights",
							"Nike Run Anti-Blister Lightweight Anklet Running Socks - SP14",
							"Nike 3-Pack Trainer Liner Running Socks",
							"New Balance Go 2 5 Inch Running Shorts",
							"Skins A200 Compression Running Tights",
							"Nike Dri-Fit Cushion Women's Anklet 3 Pack Running Socks",
							"Adidas Adizero Short Sleeve Running T-Shirt",
							"Nike Run Anti-Blister Lightweight Anklet Running Socks - SP14",
							"Nike Run Anti-Blister Lightweight Micro Running Socks - SP14",
							"Adidas Lady Essential Multifunctional Capri Running Tights",
							"Nike Equip Cushioned Crew 6 Pack Running Socks",
							"Nike Racer Women's Long Sleeve Running Top - SP14",
							"Nike Cushioned Dynamic Arch Micro Running Socks - SP14",
							"Nike Pro Core 2.0 Long Sleeve Compression Running Top",
							"Ronhill Advance Cargo Racer Running Shorts",
							"New Balance 8 Inch Tight Running Shorts",
							"ASICS Volt Run Short Sleeve Running T-Shirt",
							"Nike Women's Reversible Sports Bra",
							"ASICS Volt Crew Long Sleeve Running Top",
							"Reebok Lady Shapewear Short Sleeve T-Shirt",
							"Nike Equip Cushioned Crew 6 Pack Running Socks",
							"Nike Pro Core Women's Compression Running Tights - SP14",
							"Puma Pure Tech 7 Inch Baggy Running Shorts",
							"Asics Performance Logo Short Sleeved Running T-Shirt",
							"Nike AW77 DWR Full Zip Hooded Top",
							"Nike Dri-Fit 3 Pack Socks",
							"Puma FAAS Tech Gore Windstopper Running Jacket",
							"Adidas TechFit Women's Running Tights",
							"Nike Women's Pro Tank - SP14",
							"ASICS GORE WINDSTOPPER Half-Zip Long Sleeve Running Top",
							"Nike Challenger Germany Short Sleeve Running T-Shirt",
							"Nike 9 Phenom 2-in-1 Running Short",
							"Under Armour Lady Tech Short Sleeve Running T-Shirt",
							"Reebok Lady Shapewear Tank Top Vest",
							"Nike Dri-Fit Half-Cushion Quarter Running Socks",
							"Puma FAAS Tech Gore Windstopper Running Jacket",
							"Montane Bionic Long Sleeve Half Zip Top",
							"Nike Budmo GORE-TEX Waterproof Outdoor Pants",
							"ASICS Volt Running Jacket",
							"Nike 5 Inch Stretch Woven Running Shorts",
							"Nike Filament Women's Running Tights - SP14",
							"Nike Dri-Fit Half Cushion Quarter Running Socks (3 Packs)",
							"Skins Bio A400 Women's Compression Running Tights",
							"Adidas Response Short Sleeve T-Shirt",
							"Nike Pro Women's 3 Inch Compression Running Shorts - SP14",
							"Adidas Supernova 5 Inch Running Shorts",
							"Nike Filament Women's Running Tights - SP14",
							"ASICS Volt Run Long Sleeve Half-Zip Running Top",
							"Skins Lady She Compression Sleeveless Vest",
							"New Balance Impact Womens Running Capri Tights",
							"ASICS Volt Crew Long Sleeve Running Top",
							"Nike Element Shield Max Women's Running Jacket",
							"Nike Lady Dri-Fit No Show Running Socks (3 Packs)",
							"Saucony Performance Running Shorts",
							"Adidas Response DS Short Sleeve T-Shirt",
							"Skins Sport Compression Wear Long Sports Tights",
							"Brooks Nightlife Essential II Women's Running Jacket",
							"Adidas TechFit Women's Running Tights",
							"Nike Racer Women's Short Sleeve Running T-Shirt - SP14",
							"Nike Budmo Waterproof Cargo Outdoor Pants",
							"Puma Pure Core Running Tights",
							"Nike Lady Dri-Fit Legend 2.0 Capri Running Tights",
							"ASICS Volt Run Long Sleeve Half-Zip Running Top",
							"Hilly Mono Skin Merino Off Road Trail Socks",
							"Nike Cushioned Dynamic Arch Micro Running Socks",
							"Higher State Short Sleeve Running T-Shirt",
							"Skins Bio A200 Women's Compression Capri Running Tights");

		$values['description'] = array("Get a step ahead of the competition with the Nike 3-Pack Quarter Running Socks. Featuring Dri-FIT mo...",
						"The Hilly Mono Skin Lite Anklet (GB) Running Socks are a pair of ultra lightweight performance socks...",
						"Soft and cushioned feel, made in a soft and durable material for all day exceptional comfort, this N...",
						"High performance gear at a great price, the ASICS Volt Run 5 Inch Running Shorts are a comfortable, ...",
						"The ASICS Volt Run Short Sleeve Running T-Shirt is an ideal everyday running garment, featuring swea...",
						"Nike Dri-Fit Cushioned Dynamic Arch Anklet Running Socks have aerodynamic design that keep your feet...",
						"The ASICS Volt Run Long Running Tights are a comfortable, breathable pair of performance running tig...",
						"Built with a snug fit and ergonomic support. A competition-ready base layer that can also be worn as...",
						"These socks offer maximum ventilation for your toughest training sessions. Mesh ventilation on top p...",
						"These low cut ankle socks are designed for sportswear, as well as day to day wear. An arch support a...",
						"The ASICS LADY VESTA Running Capri Tights offer a great range of movement, with style and performanc...",
						"The ASICS Performance Logo Long Sleeve Running Top is a versatile training top for all seasons, made...",
						"High performance gear at a great price, the ASICS Volt Run 7 Inch Running Shorts are a comfortable, ...",
						"The Ronhill Classic GT Trackster Running Pants are an excellent hardwearing and comfortable running ...",
						"These low cut ankle socks are designed for sportswear, as well as day to day wear. An arch support a...",
						"The Hilly Supreme Running Gloves area superb multi-purpose glove ideal for optimal running performan...",
						"The ASICS Volt Run Short Sleeve Running T-Shirt is an ideal everyday running garment, featuring swea...",
						"Nike Dri-Fit Half Cushion Quarter Running Socks have aerodynamic design that keep your feet free of ...",
						"If you don't want the wind to slow you down during your running sessions, you need good wind protect...",
						"The Hilly Mono Skin Sport Anklet Twin Pack socks are lightweight with a cushioned performance improv...",
						"The Nike Flash Reversible Running Gilet is a fully reversible, reflective running gilet that will wi...",
						"Soft and cushioned feel, made in a soft and durable material for all day exceptional comfort, this N...",
						"The Nike Dri-FIT No Show Running Socks are ideal for easygoing workouts, providing a comfortable and...",
						"The Ronhill Classic GT Trackster Running Pants are an excellent hardwearing and comfortable running ...",
						"Never satisfied with the status quo, Under Armour have retooled one of the most popular T-shirt to b...",
						"These gloves are made for warmth and comfort without whilst being extremely lightweight. The Nike Sw...",
						"The ASICS Volt Run Short Running Tights are a comfortable, breathable pair of performance running ti...",
						"The ASICS Volt Run Long Sleeve Half-Zip Running Top is an ideal everyday running top, featuring swea...",
						"The Nike Victory Contour Women's Support Bra is designed for a compression fit and locked in feel. T...",
						"The Asics Performance Logo Short Sleeved Running T-Shirt is a versatile training top for all seasons...",
						"The Nike V-Neck Long Sleeve Compression Top is an ideal baselayer top for a range of activities that...",
						"The Under Armour 'The Original' 6 Boxer Shorts are very supportive and comfortable underwear piece ...",
						"Provide a soft feel, made in a lightweight and breathable material for exceptional comfort, this Nik...",
						"Skins Snow Tights have been developed, tested and proven to help you ski harder, for longer and reco...",
						"The Nike Anti-Blister Lightweight Anklet Running Socks (1 Pair) are made with innovative sweat-wicki...",
						"The Nike 3-Pack Trainer Liner Running Socks offer comfort on the trail, the track or the road. Featu...",
						"Featuring lightweight and breathable Lightning Dry fabric, the New Balance 5 Go 2 Running Short is ...",
						"SKINS sport products are ground breaking, body moulded, gradient compression performance equipment w...",
						"The Nike Dri-Fit Run Cushioned Anklet Running Socks are an aerodynamic fit that keep the feet dry. T...",
						"Part of the Adizero range and crafted to be super lightweight, featuring innovative FORMOTION engine...",
						"The Nike Anti-Blister Lightweight Anklet Running Socks (1 Pair) are made with innovative sweat-wicki...",
						"The Nike Anti-Blister Lightweight Micro Running Socks (1 Pair) are made with innovative sweat-wickin...",
						"These women's adidas Multifunctional Essentials Capri Tights feature soft, lightweight CLIMALITE® f...",
						"Soft and cushioned feel, made in a soft and durable material for all day exceptional comfort, this N...",
						"The Nike Racer Women's Long Sleeve Running Top has a laid-back and sport-inspired style design. Manu...",
						"Nike Dri-Fit Cushioned Dynamic Arch Micro Running Socks have aerodynamic design that keep your feet ...",
						"Nike Pro Core Compression Long Sleeve Top 2.0. Nike Pro is an innovative performance base layer appa...",
						"The Ronhill Advance Cargo Racer Running Short is an ultimate racing piece, harking back to original ...",
						"The New Balance 8 Inch Fitted Short is a great training item which can be worn as a base layer or by...",
						"The ASICS Volt Run Short Sleeve Running T-Shirt is an ideal everyday running garment, featuring swea...",
						"The Nike Women's Reversible Sports Bra is ideal for light-impact sports, featuring a lightweight, sw...",
						"The ASICS Volt Run Long Sleeve Crew Neck Running Top is an ideal everyday running top, featuring swe...",
						"Reebok Lady Shapewear T-Shirt is a perfect blend of great comfort and fit. It won't get in your way ...",
						"Soft and cushioned feel, made in a soft and durable material for all day exceptional comfort, thess ...",
						"Made with stretchy, sweat-wicking fabric, the Nike Pro Core Women's Compression Running Tights are c...",
						"The latest running shorts from PUMA, the Pure Tech 7 Inch Baggy Shorts are suitable for all kinds of...",
						"The Asics Performance Logo Short Sleeved Running T-Shirt is a versatile training top for all seasons...",
						"The Nike AW77 DWR Full Zip Hooded Top gives you a supremely comfortable, durable and warm hooded top...",
						"Lightweight and breathable technical running socks with excellent wicking properties and superb comf...",
						"If you don't want the wind to slow you down during your running sessions, you need good wind protect...",
						"Engineered to provide maximum support without compromising comfort or style, the Adidas TechFit Wome...",
						"The Nike Women's Pro Tank is designed with a cut-out racerback and flat seams for an unrestrictive f...",
						"The ASICS GORE WINDSTOPPER Half-Zip Long Sleeve Running Top will allow you to get more out of your r...",
						"The Nike Challenger Germany Short Sleeve Running T-Shirt is a lightweight, sweat-wicking performance...",
						"The Nike Phenom 9 Inch 2-In-1 Running Shorts feature a pair of interior compression-fit shorts for l...",
						"Never satisfied with the status quo, Under Armour have retooled one of the most popular T-shirt to b...",
						"Reebok Lady Shapewear Tank Top Vest is a perfect blend of great comfort and fit. It won't get in you...",
						"An aerodynamic fit that keeps feet dry and free of distractions, the Nike Dri-FIT Half Cushion Quart...",
						"If you don't want the wind to slow you down during your running sessions, you need good wind protect...",
						"This highly functional baselayer constructed with MERINO Perform™ keeps you dry and temperate duri...",
						"The Nike Budmo GORE-TEX Waterproof Outdoor Pants are built with complete full protection against win...",
						"The ASICS Volt Running Jacket is an ideal everyday running companion. A performance garment, lightwe...",
						"Utilising high-performance fabrics, the Nike 5 Inch Running Shorts are great for runners looking for...",
						"The Nike Filament Women's Running Tights offer premium comfort with an excellent range of motion tha...",
						"The Nike Dri-Fit Half Cushion Quarter Running Socks, available in a pack of 3, feature an aerodynami...",
						"Skins sport products are ground breaking, body moulded, gradient compression performance equipment w...",
						"Engineered for maximum comfort and breathability, the Adidas Response Short Sleeve Running T-Shirt i...",
						"Built with a snug fit and ergonomic support. A competition-ready base layer that can also be worn as...",
						"The Adidas Supernova 5 Inch Running Shorts are both lightweight and breathable, and provide a comfor...",
						"The Nike Filament Women's Running Tights offer premium comfort with an excellent range of motion tha...",
						"The ASICS Volt Run Long Sleeve Half-Zip Running Top is an ideal everyday running top, featuring swea...",
						"Skins sport products are ground breaking, body moulded, gradient compression performance equipment w...",
						"Designed to be as flexible as you are, the New Balance Impact Womens Capri comforts you with a mesh ...",
						"The ASICS Volt Run Long Sleeve Crew Neck Running Top is an ideal everyday running top, featuring swe...",
						"The perfect blend of protection and breathability, the Nike Element Shield Max Running Jacket featur...",
						"Featuring Nike's trademark fabric, Dri-Fit technology wick sweat away from your feet keeping it dry....",
						"The Saucony Performance Short is a classic, loose fitting short which is designed to allow great fre...",
						"ADIDAS RESPONSE DS SHORT SLEEVE T-SHIRT. There's nothing worse than reaching the 2nd mile and realiz...",
						"Skins Sport Compression Wear Long Sports Tight. This is a compression garment that protects muscles ...",
						"The Brooks Nightlife Essential II Women's Running Jacket is an ideal choice for those runs in dark a...",
						"Engineered to provide maximum support without compromising comfort or style, the Adidas TechFit Wome...",
						"The Nike Racer Women's Short Sleeve Running T-Shirt has a laid-back and sport-inspired style design....",
						"The Nike Budmo Cargo Waterproof Outdoor Pants are built for full protection against wind, rain and s...",
						"Stay cool when you exercise with the Puma Pure Core Running Tights. They provides excellent ventilat...",
						"The Nike Dri-Fit Legend 2.0 Capri Running Tights feature a tight fitting design with a touch of mode...",
						"The ASICS Volt Run Long Sleeve Half-Zip Running Top is an ideal everyday running top, featuring swea...",
						"The HILLY Mono Off Road Merino Anklet Running Sock is high performance trail specific sock designed ...",
						"Nike Dri-Fit Cushioned Dynamic Arch Micro Running Socks have aerodynamic design that keep your feet ...",
						"The Higher State Short Sleeve Running T-Shirt is a high performance technical running garment which ...",
						"Skins sport products are ground breaking, body moulded, gradient compression performance equipment...");

		$values['photo'] = array("http://images.sportsshoes.com/product/N/NIK8114/NIK8114_200_1.jpg",
						"http://images.sportsshoes.com/product/H/HIL44/HIL44_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK8116/NIK8116_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3104/ASI3104_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3093/ASI3093_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6890/NIK6890_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3101/ASI3101_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK8964/NIK8964_200_1.jpg",
						"http://images.sportsshoes.com/product/S/SAU2357/SAU2357_200_1.jpg",
						"http://images.sportsshoes.com/product/S/SAU2320/SAU2320_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI2677/ASI2677_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI2956/ASI2956_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3103/ASI3103_200_1.jpg",
						"http://images.sportsshoes.com/product/R/RON78/RON78_200_1.jpg",
						"http://images.sportsshoes.com/product/S/SAU2321/SAU2321_200_1.jpg",
						"http://images.sportsshoes.com/product/H/HIL64/HIL64_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3094/ASI3094_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6990/NIK6990_200_1.jpg",
						"http://images.sportsshoes.com/product/P/PUM954/PUM954_200_1.jpg",
						"http://images.sportsshoes.com/product/H/HIL37/HIL37_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6563/NIK6563_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6166/NIK6166_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6994/NIK6994_200_1.jpg",
						"http://images.sportsshoes.com/product/R/RON89/RON89_200_1.jpg",
						"http://images.sportsshoes.com/product/U/UND420/UND420_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK5760/NIK5760_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3102/ASI3102_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3085/ASI3085_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK8533/NIK8533_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI2959/ASI2959_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK7626/NIK7626_200_1.jpg",
						"http://images.sportsshoes.com/product/U/UND283/UND283_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6170/NIK6170_200_1.jpg",
						"http://images.sportsshoes.com/product/S/SKI63/SKI63_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK9501/NIK9501_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK8115/NIK8115_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NEW689728/NEW689728_200_1.jpg",
						"http://images.sportsshoes.com/product/S/SKI76/SKI76_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK9864/NIK9864_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ADI5934/ADI5934_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK9502/NIK9502_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK9496/NIK9496_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ADI4641/ADI4641_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6169/NIK6169_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK9405/NIK9405_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK9508/NIK9508_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6936/NIK6936_200_1.jpg",
						"http://images.sportsshoes.com/product/R/RON981/RON981_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NEW689610/NEW689610_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3092/ASI3092_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK8606/NIK8606_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3091/ASI3091_200_1.jpg",
						"http://images.sportsshoes.com/product/R/REE2247/REE2247_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6167/NIK6167_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK8965/NIK8965_200_1.jpg",
						"http://images.sportsshoes.com/product/P/PUM833/PUM833_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI2961/ASI2961_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK7214/NIK7214_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK4606/NIK4606_200_1.jpg",
						"http://images.sportsshoes.com/product/P/PUM953/PUM953_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ADI5658/ADI5658_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK8970/NIK8970_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI2911/ASI2911_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK9539/NIK9539_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK7683/NIK7683_200_1.jpg",
						"http://images.sportsshoes.com/product/U/UND421/UND421_200_1.jpg",
						"http://images.sportsshoes.com/product/R/REE2251/REE2251_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6154/NIK6154_200_1.jpg",
						"http://images.sportsshoes.com/product/P/PUM952/PUM952_200_1.jpg",
						"http://images.sportsshoes.com/product/M/MON535/MON535_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK9525/NIK9525_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3099/ASI3099_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK7418/NIK7418_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6923/NIK6923_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6998/NIK6998_200_1.jpg",
						"http://images.sportsshoes.com/product/S/SKI57/SKI57_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ADI5585/ADI5585_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK8963/NIK8963_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ADI5866/ADI5866_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK8359/NIK8359_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3086/ASI3086_200_1.jpg",
						"http://images.sportsshoes.com/product/S/SKI191/SKI191_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NEW689908/NEW689908_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3090/ASI3090_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6434/NIK6434_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6616/NIK6616_200_1.jpg",
						"http://images.sportsshoes.com/product/S/SAU1557/SAU1557_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ADI4378/ADI4378_200_1.jpg",
						"http://images.sportsshoes.com/product/S/SKI8/SKI8_200_1.jpg",
						"http://images.sportsshoes.com/product/B/BRO814/BRO814_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ADI5659/ADI5659_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK9413/NIK9413_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK9526/NIK9526_200_1.jpg",
						"http://images.sportsshoes.com/product/P/PUM834/PUM834_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK8642/NIK8642_200_1.jpg",
						"http://images.sportsshoes.com/product/A/ASI3084/ASI3084_200_1.jpg",
						"http://images.sportsshoes.com/product/H/HIL70/HIL70_200_1.jpg",
						"http://images.sportsshoes.com/product/N/NIK6896/NIK6896_200_1.jpg",
						"http://images.sportsshoes.com/product/H/HST1005/HST1005_200_1.jpg",
						"http://images.sportsshoes.com/product/S/SKI95/SKI95_200_1.jpg");

		return $values;
    }
}