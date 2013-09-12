<?php
/**
 * Coolcsn Zend Framework 2 File Manager Module
 *
 * @link https://github.com/coolcsn/CsnFileManager for the canonical source repository
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnFileManager/blob/master/LICENSE BSDLicense
 * @author Stoyan Cheresharov <stoyan@coolcsn.com>
 * @author Stoyan Revov <st.revov@gmail.com>
*/

namespace CsnFileManager;

return array(
	'controllers' => array(
        'invokables' => array(
            'CsnFileManager\Controller\Index' => 'CsnFileManager\Controller\IndexController',		
        ),
    ),	
    'router' => array(
        'routes' => array(
			'csn-file-manager' => array(
				'type'    => 'Literal',
				'options' => array(
					'route'    => '/csn-file-manager',
					'defaults' => array(
						'__NAMESPACE__' => 'CsnFileManager\Controller',
						'controller'    => 'Index',
						'action'        => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type'    => 'Segment',
						'options' => array(
							'route'    => '/[:controller[/:action[/:id]]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
							),
							'defaults' => array(
							),
						),
					),
				),
			),
		),
	),
    'view_manager' => array(
        'template_path_stack' => array(
            'csn-file-manager' => __DIR__ . '/../view'
        ),
		
		'display_exceptions' => true,
    ),
    'doctrine' => array(
        'driver' => array(
			__NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
					__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
					__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                )
            )
        )
    ),
);