f = open('2.in', 'r')

def digno(x):
    cnt = 0
    while x:
        cnt += 1
        x//=10
    return cnt

def split_in_two(x):
    s = str(x)
    p1 = s[:len(s)//2]
    p2 = s[len(s)//2:]

    return [int(p1), int(p2)]

def blink(v):
    i = 0
    while i < len(v):
        if v[i] == 0:
            v[i] = 1
        elif digno(v[i]) % 2 == 0:
            halves = split_in_two(v[i])
            del v[i]
            v.insert(i, halves[1])
            v.insert(i, halves[0])
            i+=1
        else:
            v[i] *= 2024
        i += 1
        
        
if __name__ == '__main__':
    v = [int(x) for x in f.readline().split()]
    print(v)

    for i in range(0, 75):
        blink(v)
        print(f'Blink no. {i} done!')
        #print(v)

    print(len(v))