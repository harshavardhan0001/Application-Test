import { Component, Input } from '@angular/core';
import { NgbModal,NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Output, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-add-product',
  templateUrl: './add-product.component.html',
  styleUrls: ['./add-product.component.css']
})

export class AddProductComponent {
  newProduct:any = {}
  public modalReference: NgbActiveModal = new NgbActiveModal;
  @Input() newButton!: string;
  @Output() newItemEvent = new EventEmitter<string>();
  constructor(
    private modalService: NgbModal){
      this.newProduct = {
        name : "",
        state : "",
        zip : "",
        amount : "",
        qty : "",
        item : ""
      }}

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
      createProduct(){
        if(this.newProduct.name == "" || this.newProduct.state == "" || this.newProduct.zip == "" || this.newProduct.item == ""){
          alert("Name, State, Zip and Item are required fields");
          return;
        }
        this.newItemEvent.emit(this.newProduct);
        this.modalReference.close();
      }
}
