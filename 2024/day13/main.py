f = open('2.in', 'r')

def nmbs(s):
    numbers = []
    current_number = ""

    for char in s:
        if char.isdigit():
            current_number += char
        elif current_number:
            numbers.append(int(current_number))
            current_number = ""
            if len(numbers) == 2:
                break

    if current_number and len(numbers) < 2:
        numbers.append(int(current_number))

    return numbers

def solve(ax, ay, bx, by, px, py, add=0):
  px += add
  py += add

  t1 , t2 = bx*py - by*px, bx*ay - by*ax
  if t1%t2: 
    return 0
    
  ak = t1//t2
  t3 = px-ax*ak

  if t3%bx: 
    return 0
  
  bk = t3//bx
  return ak*3+bk


if __name__ == '__main__':
    lines = f.readlines()

    ans = 0

    for i in range(0, len(lines), 4):
        xa, ya = nmbs(lines[i])
        xb, yb = nmbs(lines[i+1])
        targetX, targetY = nmbs(lines[i+2])

        ans += solve(xa, ya, xb, yb, targetX, targetY, add=10000000000000)

         

    print(ans)