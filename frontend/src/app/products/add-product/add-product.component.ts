import { Component, Input, TemplateRef } from '@angular/core';
import { NgbModal,NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Output, EventEmitter } from '@angular/core';
import { Iproduct } from '../models/iproduct';

@Component({
  selector: 'app-add-product',
  templateUrl: './add-product.component.html',
  styleUrls: ['./add-product.component.css']
})

export class AddProductComponent {
  newProduct:any = {}
  public modalReference: NgbActiveModal = new NgbActiveModal;
  @Input() newButton!: string;
  @Output() newItemEvent = new EventEmitter<Iproduct>();
  constructor(private modalService: NgbModal){}
/**
 * Open's this.modalReference binding the template referred.
 *
 * @param {TemplateRef} content content must be modal template ref.
 */
  addProduct(content:any) {
    this.newProduct = {
      name : "",
      state : "",
      zip : "",
      amount : "",
      qty : "",
      item : ""
    }
    this.modalReference = this.modalService.open(content, { centered: true  });
  }
  
/**
 * Validate create product form and emit new product data to product component.
 */
  createProduct(){
    if(this.newProduct.name == "" || this.newProduct.state == "" || this.newProduct.zip == "" || this.newProduct.item == ""){
      alert("Name, State, Zip and Item are required fields");
      return;
    }
    this.newItemEvent.emit(this.newProduct);
    this.modalReference.close();
  }
}
