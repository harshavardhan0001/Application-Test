
import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { Inotify } from '../models/iproduct';

@Injectable({
  providedIn: 'root'
})

export class NotifyService {
  newNotification = new BehaviorSubject<Inotify>({success:false,msg:""});
  getNewNotification = this.newNotification.asObservable()

  setNewNotification(notifyMsg:Inotify) {
      this.newNotification.next(notifyMsg);
  }
}