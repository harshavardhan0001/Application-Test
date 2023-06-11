import { Component} from '@angular/core';
import { NgbModal,NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Output, EventEmitter } from '@angular/core';
import { Iproduct } from '../../../models/iproduct';
import { FormGroup,  Validators, FormBuilder } from '@angular/forms';

@Component({
  selector: 'app-add-product',
  templateUrl: './add-product.component.html',
  styleUrls: ['./add-product.component.css']
})

export class AddProductComponent {
  // FormGroup for adding new product
  newProduct:FormGroup;

  // To alert when invalid data tried to sumbit in add product form
  submitted = false;
  
  // NgbActiveModel for add new product form
  public modalReference: NgbActiveModal = new NgbActiveModal;

  // returns the New Product form data to product component
  @Output() newItemEvent = new EventEmitter<Iproduct>();


  constructor(private modalService: NgbModal,private fb: FormBuilder){
    
    this.newProduct = this.fb.group({
      name: ["", [Validators.required, Validators.minLength(4), Validators.pattern('[a-zA-Z ]*') ]],
      state: ["", [Validators.required, Validators.minLength(4)]],
      zip: ["", [ Validators.required,Validators.maxLength(5),Validators.minLength(5), Validators.pattern(/^-?(0|[1-9]\d*)?$/) ]],
      amount: ["", [Validators.required, Validators.pattern(/^(?:[0-9]+(?:\.[0-9]{0,2})?)?$/) ]],
      quantity: ["", [Validators.required, Validators.pattern(/^-?(0|[1-9]\d*)?$/) ]],
      item: ["", [ Validators.required,Validators.maxLength(6) ]]
    });
  }

/**
 * Open's this.modalReference binding the template referred.
 *
 * @param {TemplateRef} content content must be modal template ref.
 */
  addProduct(content:any) {
    this.modalReference = this.modalService.open(content, { centered: true  });
  }
  
/**
 * Validate create product form and emit new product data to product component.
 */
  createProduct(){
    this.submitted = true;
    setTimeout(()=> this.submitted = false,2500)
    if (this.newProduct.invalid) {
      return;
    }
    this.newItemEvent.emit(this.newProduct.value);
    this.modalReference.close();
    this.newProduct.reset()
  }
}
