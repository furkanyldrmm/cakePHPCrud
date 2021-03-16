<?php

class PostsController extends AppController
{
	public $helpers = array('Html', 'Form');

	public function index()
	{
		$this->set('posts', $this->Post->find('all'));
	}


	public function view($id = null)
	{
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('post', $post);
	}


	public function add()
	{
		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('Your post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Unable to add your post.'));
		}
	}


	public function edit($id = null)
	{
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Post->id = $id;
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('Your post has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(__('Unable to update your post.'));
		}

		if (!$this->request->data) {
			$this->request->data = $post;
		}
	}


	public function delete($id)
	{
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Post->delete($id)) {
			$this->Flash->success(
				__('The post with id: %s has been deleted.', h($id))
			);
		} else {
			$this->Flash->error(
				__('The post with id: %s could not be deleted.', h($id))
			);
		}

		return $this->redirect(array('action' => 'index'));
	}


	public function sorgular(){
		$cargoorders= $this -> Order -> find('all', array('conditions' => array('Order.seller_id' => $cominfo['id'],'Order.status' => 2),'order' => array('Cargo.priority ASC')
		,'fields' => array('Order.id','Order.trade','Company.username','Company.owner','Company.title','Seller.einvoice_status','Company.id','Cargo.title','Order.cargo_id','Order.wait_date','Order.price','Order.tracking_number','Order.cargo_print','Order.bill_print','Seller.cargo_id','Order.selected_cargo_format','Order.ischanged','Order.cargo_price','Order.price_discount')));
		$this-> set('cwbaskets', $this -> Basket -> find('all', array('conditions' => array('Order.seller_id' => $cominfo['id'],'Order.status' => 2,'Basket.status' => 2),'order' => array('Basket.order_id DESC')
		,'fields' => array('Basket.campaign_id','Basket.order_id','Basket.product_id','Basket.count','Product.image','Product.title','Product.brand_id','Product.id','Basket.order_price','Basket.miad'))));
		$this-> set('cargoorders',$cargoorders);
	}
}
