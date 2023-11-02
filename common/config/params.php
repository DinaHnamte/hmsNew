<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    'app-ids' => ['1000' => 'ADMIN', '1001' => 'HOSPITAL', '1002' => 'Clinic', '1003' => 'Pharmacy',
                    '1004' => 'X - Ray', '1005' => 'Laboratory'
                 ],
    'gender' => ['F' => 'Female','M' => 'Male', 'TG' => 'Transgender'],
    'blgroup' => ['A+' => 'A+', 'B+' => 'B+','AB+' => 'AB+', 'O+' => 'O+',
					'A-' => 'A-', 'B-' => 'B-','AB-' => 'AB-', 'O-' => 'O-','NA' => 'NA'],
                    'religion' => ['Christian' => 'Christian', 'Buddhish' => 'Buddhish',
					'Hindu' => 'Hindu', 'Muslim' => 'Muslim',
					'Sikh' => 'Sikh', 'Parsis' => 'Parsis', 'Jain' => 'Jain', 'Atheist' => 'Atheist'],
    'caste' => ['ST' => 'ST', 'SC' => 'SC','General' => 'General', 'OBC' => 'OBC'],
    'vitalsigns' => ['bp' => 'blood pressure','temp' => 'Temperature', 
                        'pulse' => 'Pulse Rate', 'heartrate' => 'Heart Rate',
                        'weight' => 'Weight', 'girth' => 'Girth'
                    ],
    'tenant-id' => '6533ee57d206a',
];
