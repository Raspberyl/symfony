<?php

namespace William\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use William\EcommerceBundle\Entity\Brand;

class LoadBrands extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$titles = array("Adidas", "Nike", "Puma", "Quicksilver", "Fila", "Courir", "Asics");

		foreach($titles as $i => $title)
		{
			$list[$i] = new Brand();
			$list[$i]->setTitle($title);
			$list[$i]->setLogo('img/brand/'.strtolower($title).'.png');
			
			$manager->persist($list[$i]);
			$this->addReference($i.'-brand', $list[$i]);
		}
		$manager->flush();
	}

	public function getOrder()
    {
        return 2;
    }
}