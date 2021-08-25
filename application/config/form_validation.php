<?php 

$config= [

'admin_login'=>	[
						[
							'field'=> 'username',
							'label'=> 'Username',
							'rules'=> 'trim|required|min_length[5]|max_length[20]'
						],
						[
							'field'=> 'password',
							'label'=> 'Password',
							'rules'=> 'trim|required|min_length[3]'
						]
				  	],

'add_user_rules'=>	[
						[
							'field'=> 'fname',
							'label'=> 'First Name',
							'rules'=> 'required'
						],
						[
							'field'=> 'lname',
							'label'=> 'Last Name',
							'rules'=> 'required'
						],
						[
							'field'=> 'username',
							'label'=> 'Username',
							'rules'=> 'trim|required|min_length[5]|max_length[21]'
						],
						[
							'field'=> 'email',
							'label'=> 'Email',
							'rules'=> 'required'
						],
						[
							'field'=> 'mobileno',
							'label'=> 'Mobile No',
							'rules'=> 'required|min_length[10]|max_length[15]'
						],
						[
							'field'=> 'password',
							'label'=> 'Password',
							'rules'=> 'trim|required|min_length[3]'
						]
				  	],

'update_user_rules'=>	[
						[
							'field'=> 'fname',
							'label'=> 'First Name',
							'rules'=> 'required'
						],
						[
							'field'=> 'lname',
							'label'=> 'Last Name',
							'rules'=> 'required'
						],
						[
							'field'=> 'username',
							'label'=> 'Username',
							'rules'=> 'trim|required|min_length[5]|max_length[21]'
						],
						[
							'field'=> 'email',
							'label'=> 'Email',
							'rules'=> 'required'
						],
						[
							'field'=> 'mobileno',
							'label'=> 'Mobile No',
							'rules'=> 'required|min_length[10]|max_length[15]'
						]
				  	]

];

?>