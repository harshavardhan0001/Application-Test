import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AddProductComponent } from './add-product.component';
import { ReactiveFormsModule } from '@angular/forms';
import { NgbModal, NgbModalRef } from '@ng-bootstrap/ng-bootstrap';
import { Iproduct } from '../../models/iproduct';
// Mock class for NgbModalRef
// Mock class for NgbModalRef
export class MockNgbModalRef {
  componentInstance = {
      prompt: undefined,
      title: undefined
  };
  result: Promise<any> = new Promise((resolve, reject) => resolve(true));
}

describe('AddProductComponent', () => {
  let component: AddProductComponent;
  let fixture: ComponentFixture<AddProductComponent>;
  let modalServiceSpy: jasmine.SpyObj<NgbModal>;
  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ReactiveFormsModule],
      declarations: [ AddProductComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AddProductComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should open add product form', () => {
    fixture.componentInstance.addProduct('foo');
    fixture.detectChanges();
    expect(fixture.nativeElement.innerText).toBe('Add Product')
  });

  it('Should validate on submit', () => {
    const newItem ={ name: '', state: '', zip: '', amount: 0, quantity:0 , item: '' };
    component.createProduct();
    component.newProduct.setValue(newItem)
    expect(component.submitted).toBeTrue();
    expect(component.newProduct.invalid).toBeTrue();
  });
});
