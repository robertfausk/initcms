<?php
namespace Sandbox\InitCmsBundle\DataFixtures\ORM;

/**
 * This file is part of the Networking package.
 *
 * (c) net working AG <info@networking.ch>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */



use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Networking\InitCmsBundle\Entity\Page;

/**
 * @author net working AG <info@networking.ch>
 */
class LoadPages extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    private $container;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $languages = $this->container->getParameter('networking_init_cms.page.languages');

        foreach ($languages as $key => $lang) {
            $this->createHomePages($manager, $lang['locale'], $key, $languages);
        }
    }

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     * @param string $locale
     * @param integer $key
     * @param array $languages
     */
    public function createHomePages(ObjectManager $manager, $locale, $key, $languages)
    {
        $homePage = new Page();

        $homePage->setLocale($locale);
        $homePage->setpageName('Homepage '.$locale);
        $homePage->setMetaTitle('Homepage '.$locale);
        $homePage->setMetaKeyword('homepage');
        $homePage->setMetaDescription('This is the homepage');
        $homePage->setStatus(Page::STATUS_PUBLISHED);
        $homePage->setIsHome(true);
        $homePage->setTemplate($this->getFirstTemplate());
        $homePage->setActiveFrom(new \DateTime('now'));

        // set original for translations
        if($key > 0)
        {
            $firstPage = $this->getReference('homepage_'.$languages['0']['locale']);
            $homePage->setOriginal($firstPage);
        }

        $manager->persist($homePage);
        $manager->flush();

        $this->addReference('homepage_'.$locale, $homePage);
    }

    /**
     * @return array
     */
    protected function getFirstTemplate()
    {
        $templates = $this->container->getParameter('networking_init_cms.page.templates');

        foreach ($templates as $key => $template) {
            return $template['template'];
        }
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
