<?php
/**
 * SettingController
 * @package site-profile-setting
 * @version 0.0.1
 */

namespace SiteProfileSetting\Controller;

use LibForm\Library\Form;
use Profile\Model\Profile;
use SiteProfileSetting\Library\Meta;

class SettingController extends \Site\Controller
{
    private function accountEdit(array &$params, object $profile){
        $params['info']->title = 'Edit Profile Account';

        $form            = new Form('site.profile.account');
        $params['form']  = $form;
        $params['saved'] = false;

        if(!($valid = $form->validate($profile)))
            return;

        if(!Profile::set((array)$valid, ['id'=>$profile->id]))
            deb(Profile::lastError());

        $params['saved'] = true;
    }

    private function contactEdit(array &$params, object $profile){
        $params['info']->title = 'Edit Profile Contact';

        $form            = new Form('site.profile.contact');
        $params['form']  = $form;
        $params['saved'] = false;

        if(!($valid = $form->validate($profile)))
            return;

        $svalid = [
            'contact' => []
        ];
        foreach($valid as $k => $v){
            if(substr($k, 0, 8) != 'contact-'){
                $svalid[$k] = $v;
                continue;
            }
            $kn = substr($k, 8);
            $svalid['contact'][$kn] = $v;
        }

        $svalid['contact'] = json_encode($svalid['contact']);

        if(!Profile::set((array)$svalid, ['id'=>$profile->id]))
            deb(Profile::lastError());

        $params['saved'] = true;
    }

    private function educationEdit(array &$params, object $profile){
        $params['info']->title = 'Edit Profile Educations';

        $form            = new Form('site.profile.education');
        $params['form']  = $form;
        $params['saved'] = false;

        if(!($valid = $form->validate($profile)))
            return;

        if(!Profile::set((array)$valid, ['id'=>$profile->id]))
            deb(Profile::lastError());

        $params['saved'] = true;
    }

    private function generalEdit(array &$params, object $profile){
        $params['info']->title = 'Edit Profile Details';

        $form            = new Form('site.profile.general');
        $params['form']  = $form;
        $params['saved'] = false;

        if(!($valid = $form->validate($profile)))
            return;

        if(!Profile::set((array)$valid, ['id'=>$profile->id]))
            deb(Profile::lastError());

        $params['saved'] = true;
    }

    private function passwordEdit(array &$params, object $profile){
        $params['info']->title = 'Edit Profile Password';

        $form            = new Form('site.profile.password');
        $params['form']  = $form;
        $params['saved'] = false;

        if(!($valid = $form->validate($profile)))
            return;

        if(!password_verify($valid->{'old-password'}, $profile->password))
            return $form->addError('old-password', 0, 'The password is not correct');

        if($valid->password != $valid->{'retype-password'})
            return $form->addError('retype-password', 0, 'Both password not match');

        $svalid = [
            'password' => password_hash($valid->password, PASSWORD_DEFAULT)
        ];

        if(!Profile::set($svalid, ['id'=>$profile->id]))
            deb(Profile::lastError());

        $params['saved'] = true;
    }

    private function professionEdit(array &$params, object $profile){
        $params['info']->title = 'Edit Profile Professions';

        $form            = new Form('site.profile.profession');
        $params['form']  = $form;
        $params['saved'] = false;

        if(!($valid = $form->validate($profile)))
            return;

        if(!Profile::set((array)$valid, ['id'=>$profile->id]))
            deb(Profile::lastError());

        $params['saved'] = true;
    }

    private function socialEdit(array &$params, object $profile){
        $params['info']->title = 'Edit Profile Socials';

        $form            = new Form('site.profile.social');
        $params['form']  = $form;
        $params['saved'] = false;

        if(!($valid = $form->validate($profile)))
            return;

        if(!Profile::set((array)$valid, ['id'=>$profile->id]))
            deb(Profile::lastError());

        $params['saved'] = true;
    }

    public function editAction(){
        if(!$this->profile->isLogin())
            return $this->show404();

        $tabs = [
            'account',
            'contact',
            'education',
            'general',
            'password',
            'profession',
            'social'
        ];

        $type = $this->req->param->type;
        if(!in_array($type,$tabs))
            return $this->show404();

        $method = $type . 'Edit';

        $profile = Profile::getOne(['id'=>$this->profile->id]);
        $profile->contact = json_decode($profile->contact);
        
        $params = [
            'info' => (object)[
                'title' => 'Profile Editor',
                'description' => 'General profile editor'
            ],
            'profile' => $profile
        ];

        $this->{$method}($params, $profile);

        $params['meta'] = Meta::single($params['info'], $type);

        $this->res->render('profile/setting/' . $type, $params);
        $this->res->send();
    }
}