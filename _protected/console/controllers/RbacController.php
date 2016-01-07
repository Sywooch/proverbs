<?php
namespace app\console\controllers;

use yii\helpers\Console;
use yii\console\Controller;
use Yii;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // ADD RULES
        $DevRule = new \app\rbac\rules\DevRule;
        $auth->add($DevRule);

        $MasterRule = new \app\rbac\rules\MasterRule;
        $auth->add($MasterRule);

        $AdminRule = new \app\rbac\rules\AdminRule;
        $auth->add($AdminRule);

        $PrincipalRule = new \app\rbac\rules\PrincipalRule;
        $auth->add($PrincipalRule);

        $TeacherRule = new \app\rbac\rules\TeacherRule;
        $auth->add($TeacherRule);

        $CashierRule = new \app\rbac\rules\CashierRule;
        $auth->add($CashierRule);

        $StaffRule = new \app\rbac\rules\StaffRule;
        $auth->add($StaffRule);

        $ParentRule = new \app\rbac\rules\ParentRule;
        $auth->add($ParentRule);

        
        // ADD PERMISSIONS

        // ADD "manageUsers" PERMISSION
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Allows Dev/Master roles to manage users';
        $auth->add($manageUsers);

        // ADD "accessDevDashboard" PERMISSION
        $accessDevDashboard = $auth->createPermission('accessDevDashboard');
        $accessDevDashboard->description = 'Allows Dev role to access Dev Dashboard';
        $auth->add($accessDevDashboard);

        // ADD "accessMasterDashboard" PERMISSION
        $accessMasterDashboard = $auth->createPermission('accessMasterDashboard');
        $accessMasterDashboard->description = 'Allows Master role to access Master Dashboard';
        $auth->add($accessMasterDashboard);

        // ADD "accessAdminDashboard" PERMISSION
        $accessAdminDashboard = $auth->createPermission('accessAdminDashboard');
        $accessAdminDashboard->description = 'Allows Admin role to access Admin Dashboard';
        $auth->add($accessAdminDashboard);

        // ADD "accessPrincipalDashboard" PERMISSION
        $accessPrincipalDashboard = $auth->createPermission('accessPrincipalDashboard');
        $accessPrincipalDashboard->description = 'Allows Principal role to access Principal Dashboard';
        $auth->add($accessPrincipalDashboard);

        // ADD "accessTeacherDashboard" PERMISSION
        $accessTeacherDashboard = $auth->createPermission('accessTeacherDashboard');
        $accessTeacherDashboard->description = 'Allows Teacher role to access Teacher Dashboard';
        $auth->add($accessTeacherDashboard);

        // ADD "accessCashierDashboard" PERMISSION
        $accessCashierDashboard = $auth->createPermission('accessCashierDashboard');
        $accessCashierDashboard->description = 'Allows Cashier role to access Cashier Dashboard';
        $auth->add($accessCashierDashboard);

        // ADD "accessStaffDashboard" PERMISSION
        $accessStaffDashboard = $auth->createPermission('accessStaffDashboard');
        $accessStaffDashboard->description = 'Allows Staff role to access Staff Dashboard';
        $auth->add($accessStaffDashboard);

        // ADD "accessParentDashboard" PERMISSION
        $accessParentDashboard = $auth->createPermission('accessParentDashboard');
        $accessParentDashboard->description = 'Allows Parent role to access Parent Dashboard';
        $auth->add($accessParentDashboard);



        // ROLES

        // ADD ADMIN ROLE
        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator';
        $auth->add($admin);
        $auth->addChild($admin, $accessAdminDashboard);
        $auth->addChild($admin, $accessPrincipalDashboard);
        $auth->addChild($admin, $accessTeacherDashboard);
        $auth->addChild($admin, $accessCashierDashboard);
        $auth->addChild($admin, $accessStaffDashboard);

        // ADD PRINCIPAL ROLE
        $principal = $auth->createRole('principal');
        $principal->description = 'Principal';
        $auth->add($principal);
        $auth->addChild($principal, $accessPrincipalDashboard);

        // ADD TEACHER ROLE
        $teacher = $auth->createRole('teacher');
        $teacher->description = 'Teacher';
        $auth->add($teacher);
        $auth->addChild($teacher, $accessTeacherDashboard);

        // ADD CASHIER ROLE
        $cashier = $auth->createRole('cashier');
        $cashier->description = 'Cashier';
        $auth->add($cashier);
        $auth->addChild($cashier, $accessCashierDashboard);
        $auth->addChild($cashier, $accessStaffDashboard);

        // ADD STAFF ROLE
        $staff = $auth->createRole('staff');
        $staff->description = 'Staff';
        $auth->add($staff);
        $auth->addChild($staff, $accessStaffDashboard);

        // ADD PARENT ROLE
        $Parent = $auth->createRole('parent');
        $Parent->description = 'Parent';
        $auth->add($Parent);
        $auth->addChild($Parent, $accessParentDashboard);

        // ADD DEV
        $dev = $auth->createRole('dev');
        $dev->description = 'Developer';
        $auth->add($dev); 
        $auth->addChild($dev, $admin);


        // ADD MASTER ROLE
        $master = $auth->createRole('master');
        $master->description = 'Master/Owner';
        $auth->add($master);
        $auth->addChild($master, $admin);
        
        if ($auth) 
        {
            $this->stdout("\nRbac authorization data are installed successfully.\n", Console::FG_GREEN);
        }
    }
}