<?php
return array(
	'bjyauthorize'=>array(
		'default_role'=>'khach',

		'identity_provider'=>'\BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',

		'role_providers'=>array(
			'BjyAuthorize\Provider\Role\ObjectRepositoryProvider'=>array(
				'role_entity_class'=>'DanhMuc\Entity\Role',
				'object_manager'=>'doctrine.entitymanager.orm_default',
				),
			),
		),
	);
?>