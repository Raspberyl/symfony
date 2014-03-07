<?php

namespace William\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use William\EcommerceBundle\Entity\Category;

class LoadCategories extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $manager)
	{
		$categories = array(
							'Athlétisme', 
							'Aviron', 
							'Badminton', 
							'Baseball', 
							'Basket-Ball', 
							'Boxe', 
							'Canoë-Kayak', 
							'Cylisme', 
							'Escrime', 
							'Foot-Ball', 
							'Gymnastique', 
							'Haltérophilie', 
							'Hand-Ball', 
							'Hockey', 
							'Judo', 
							'Lutte', 
							'Natation',
							'Pentathlon', 
							'Soft Ball', 
							'Sports Equestre', 
							'Taekwondo', 
							'Tennis', 
							'Tennis de Table', 
							'Tir', 
							'Tir à l\'Arc', 
							'Triathlon', 
							'Voile', 
							'Volley-Ball'
							);

		foreach($categories as $i => $title)
		{
			$list[$i] = new Category();
			$list[$i]->setTitle($title);
			
			$manager->persist($list[$i]);
			$this->addReference($i.'-category', $list[$i]);
		}

		$manager->flush();
	}

	public function getOrder()
    {
        return 1;
    }
}