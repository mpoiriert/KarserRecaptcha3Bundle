<?php declare(strict_types=1);

namespace Karser\Recaptcha3Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class Recaptcha3Type extends AbstractType
{
    /** @var string */
    private $siteKey;

    /** @var bool */
    private $enabled;

    public function __construct(string $siteKey, bool $enabled)
    {
        $this->siteKey = $siteKey;
        $this->enabled = $enabled;
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['site_key'] = $this->siteKey;
        $view->vars['enabled'] = $this->enabled;
        $view->vars['action_name'] = $options['action_name'];
    }

    public function getParent(): string
    {
        return HiddenType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'karser_recaptcha3';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'mapped' => false,
            'site_key' => null,
            'action_name' => 'homepage',
        ]);
    }
}
