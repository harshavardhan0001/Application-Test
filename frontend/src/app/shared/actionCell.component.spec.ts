import { ComponentFixture, TestBed } from '@angular/core/testing';
import { ActionCellRenderer } from './actionCell.component';

describe('ActionCellRenderer', () => {
  let component: ActionCellRenderer;
  let fixture: ComponentFixture<ActionCellRenderer>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ActionCellRenderer]
    }).compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ActionCellRenderer);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should initialize isCurrentRowEditing to false', () => {
    expect(component.isCurrentRowEditing).toBeFalse();
  });
  
  it('should initialize isCurrentRowEditing to true and show update instead of edit', () => {
    component.isCurrentRowEditing=true;
    fixture.detectChanges();
    const compiled = fixture.nativeElement as HTMLElement;
    expect(compiled.querySelector('.btn-outline-info')?.textContent).toContain('Update');
  });

});