<?php
declare(strict_types=1);

namespace CustomSettings\Controller;

use CustomSettings\Controller\AppController;
use CustomSettings\CustomSettings;
use CustomSettings\Exception\DuplicateRegistryException;
use CustomSettings\Exception\InvalidSettingTypeException;

/**
 * CustomSettings Controller
 *
 * @property \CustomSettings\Model\Table\CustomSettingsTable $CustomSettings
 * @method \CustomSettings\Model\Entity\CustomSetting[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomSettingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $customSettings = $this->paginate($this->CustomSettings);

        $this->set(compact('customSettings'));
    }

    /**
     * View method
     *
     * @param string|null $id Custom Setting id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customSetting = $this->CustomSettings->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('customSetting'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customSetting = $this->CustomSettings->newEmptyEntity();
        if ($this->request->is('post')) {
            try {
                CustomSettings::write($this->request->getData(), false);
                $this->Flash->success(__('The custom setting has been saved.'));

                return $this->redirect(['action' => 'index']);
            } catch (DuplicateRegistryException $e) {
                $customSetting->setError('name', $e->getMessage());
            } catch (InvalidSettingTypeException $e) {
                $customSetting->invalid_value = $this->request->getData('value');
                $customSetting->setError('value', $e->getMessage());
            }
            $this->Flash->error(__('The custom setting could not be saved. Please, try again.'));
        }
        $this->set(compact('customSetting'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Custom Setting id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customSetting = $this->CustomSettings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            try {
                $customSetting = $this->CustomSettings->patchEntity($customSetting, $this->request->getData());
                CustomSettings::write($customSetting, true);
                $this->Flash->success(__('The custom setting has been edited.'));

                return $this->redirect(['action' => 'index']);
            } catch (DuplicateRegistryException $e) {
                $customSetting->setError('name', $e->getMessage());
            } catch (InvalidSettingTypeException $e) {
                $customSetting->invalid_value = $this->request->getData('value');
                $customSetting->setError('value', $e->getMessage());
            }
            $this->Flash->error(__('The custom setting could not be saved. Please, try again.'));
        }
        $this->set(compact('customSetting'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Custom Setting id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customSetting = $this->CustomSettings->get($id);
        if ($this->CustomSettings->delete($customSetting)) {
            $this->Flash->success(__('The custom setting has been deleted.'));
        } else {
            $this->Flash->error(__('The custom setting could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
