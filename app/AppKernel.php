<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
	public function registerBundles()
	{
		$bundles = array(
			new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
			new Symfony\Bundle\SecurityBundle\SecurityBundle(),
			new Symfony\Bundle\TwigBundle\TwigBundle(),
			new Symfony\Bundle\MonologBundle\MonologBundle(),
			new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
			new Symfony\Bundle\AsseticBundle\AsseticBundle(),
			new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
			new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
			new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
			new JMS\AopBundle\JMSAopBundle(),
			new JMS\DiExtraBundle\JMSDiExtraBundle($this),
			new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
			new JMS\SerializerBundle\JMSSerializerBundle($this),
			new Knp\Bundle\MenuBundle\KnpMenuBundle(),
			new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
			new Mopa\Bundle\BootstrapBundle\MopaBootstrapBundle(),
			new FOS\UserBundle\FOSUserBundle(),
			new Sonata\AdminBundle\SonataAdminBundle(),
			new Sonata\jQueryBundle\SonatajQueryBundle(),
			new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
			new Sonata\BlockBundle\SonataBlockBundle(),
			new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
			new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
			new Sonata\MediaBundle\SonataMediaBundle(),
			new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
			new Symfony\Cmf\Bundle\RoutingExtraBundle\SymfonyCmfRoutingExtraBundle(),
			new Networking\InitCmsBundle\NetworkingInitCmsBundle(),
            new Sandbox\InitCmsBundle\SandboxInitCmsBundle(),
            new Ibrows\Bundle\SonataAdminAnnotationBundle\IbrowsSonataAdminAnnotationBundle(),
		);

		if (in_array($this->getEnvironment(), array('dev', 'test')))
		{
			$bundles[] = new Acme\DemoBundle\AcmeDemoBundle();
			$bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
			$bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
			$bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
		}

		return $bundles;
	}

	public function registerContainerConfiguration(LoaderInterface $loader)
	{
		$loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
	}
}
